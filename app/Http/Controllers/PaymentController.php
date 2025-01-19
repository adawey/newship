<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\ShipingDetail;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //
    public function getdetails(Request $request){
        $r = ShipingDetail::find($request->id);
        
        return response()->json(['message' => "done", "err" => false], 200);
    }

    public function newpay(Request $request){
        $us = User::find(Auth()->user()->id);
        if($us->balance < $request->paym){
            return response()->json(['message' => "لا يوجد رصيد كافي", "err" => true], 200);
        }else{
            DB::table('users')
            ->where('id', $us->id)
                ->update(['balance' => $us->balance - $request->paym ]);
        }
        $pay = new Payment();
        $pay->details_id = $request->id;
        $pay->auth_id = Auth()->user()->id;
        $pay->amount = $request->paym;
        $pay->save();
        $pays = Payment::where('details_id', $request->id)->sum('amount');
        $r = ShipingDetail::find($request->id);
        $r->residual = $r->due - $pays;
        $r->save();

        return response()->json(['message' => "done", "err" => false], 200);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('ship_num', function ($row) {
                    $num = $row->branch->mainship->ship_number;
                    return $num;
                })
                ->addColumn('driver', function ($row) {
                    $driver = $row->branch->driv->name;
                    return $driver;
                })
                ->addColumn('led', function ($row) {
                    $led = $row->leader->name;
                    return $led;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" value="' . $row->id . '" class="delete btn m-1 btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '"  class="print btn btn-warning btn-sm"><i class="fas fa-print"></i></a>';
                    return $actionBtn;
                })
                ->filter(
                    function ($instance) use ($request) {}
                )
                ->rawColumns(['action', 'led','ship_num','driver'])
                ->make(true);
        }
        return view('payment.index');
    }
}

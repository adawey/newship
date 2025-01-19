<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\Models\VendorPayment;

class VendorPaymentController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VendorPayment::select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('vendor', function ($row) {
                    $vendor = $row->vendor->name;
                    return $vendor;
                })
                
                ->addColumn('led', function ($row) {
                    $led = $row->leader->name;
                    return $led;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" value="' . $row->id . '"  class="print btn btn-warning btn-sm"><i class="fas fa-print"></i></a>';
                    return $actionBtn;
                })
                ->filter(
                    function ($instance) use ($request) {}
                )
                ->rawColumns(['action', 'led','vendor'])
                ->make(true);
        }
        return view('vendorpayment.index');
    }

    public function printrec($id){
        $pay = VendorPayment::find($id);
        return view('vendorpayment.print',compact('pay'));
    }
}

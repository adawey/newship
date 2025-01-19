<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class DriverController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Driver::select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('driver.edit', $row->id);
                    $show = route('shiping.enterDriver', $row->id);
                    $actionBtn = '<a href="' . $edit . '" class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="info btn m-1 btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="delete btn m-1 btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    // $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '"  class="prices m-1 btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    return $actionBtn;
                })

                ->filter(
                    function ($instance) use ($request) {}
                )
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('driver.index');
    }
    public function store(Request $request)
    {
        $dr = new Driver();
        $dr->name = $request->name;
        $dr->save();
        $msg = 'تم اضافة  سائق رقم  _ ' .  $dr->id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }

    public function driverjson(Request $request)
    {
        $data = Driver::all();
        return response()->json(['data' => $data], 200);
    }
    public function delete(Request $request)
    {
        $data =  Driver::find($request->id);
        $data->delete();
        return
            response()->json(['msg' => "done", "err" => false], 200);
    }

    public function edit($id)
    {
        $driver = Driver::find($id);
        return view('driver.edit', compact('driver'));
    }

    public function update(Request $request)
    {

        $dr =  Driver::find($request->id);
        $dr->name = $request->name;
        $dr->save();
        return  response()->json(['message' => "done", "err" => false], 200);
    }
}

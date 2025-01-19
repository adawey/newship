<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Type::select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('parentt', function ($row) {
                    $parent = '__';
                    if($row->parent_id){
                        $parent = $row->parent->name ?? " ";
                    }
                    return $parent;
                })
                ->addColumn('action', function ($row) {
                    $edit = route('types.edit', $row->id) ;
                    $show = "";
                    $actionBtn = '<a href="' . $edit . '" class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                   
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="delete btn m-1 btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    // $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '"  class="prices m-1 btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    return $actionBtn;
                })
                ->filter(
                    function ($instance) use ($request) {}
                )
                ->rawColumns(['action','parentt'])
                ->make(true);
        }
        return view('type.index');
    }
    public function store(Request $request)
    {
        $dr = new Type();
        $dr->name = $request->name;
        $dr->days = $request->days;
        $dr->daystwo = $request->daystwo;
        $dr->overnightone = $request->overnightone;
        $dr->nolon = $request->nolon;
        $dr->overnight = $request->overnight;
        if($request->parent_id){
            $dr->parent_id = $request->parent_id;
        }
        $dr->save();
        $msg = 'تم اضافة نوع رحله  رقم  _ ' .  $dr->id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }

    public function edit($id){
        $type = Type::find($id);
        return view('type.edit', compact('type'));

    }
    public function update(Request $request){

        $dr =  Type::find($request->id);
      
        $dr->name = $request->name;
        $dr->days = $request->days;
        $dr->daystwo = $request->daystwo;
        $dr->overnightone = $request->overnightone;
        $dr->nolon = $request->nolon;
        $dr->overnight = $request->overnight;
        if($request->parent_id){
            $dr->parent_id = $request->parent_id;
        }
        $dr->save();
        $msg = 'تم تعديل نوع رحله  رقم  _ ' .  $dr->id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }

    public function typesjson(Request $request){
        $data = Type::all();
        return response()->json(['data' => $data], 200);
    }
    public function delete(Request $request)
    {
        $data =  Type::find($request->id);
        $data->delete();
        return response()->json(['msg' => "done", "err" => false], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Deputy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeputyController extends Controller
{

    public function index(){

        return view('deputy.index');
    }
    
    public function store(Request $request){
        $dr = new Deputy();
        $dr->name = $request->name;
        $dr->save();
        $msg = 'تم اضافة  مندوب رقم  _ ' .  $dr->id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }
}

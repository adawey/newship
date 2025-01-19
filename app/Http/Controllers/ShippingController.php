<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use DataTables;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Models\ShipingDetail;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ShippingController extends Controller
{
    //
    public  $add2 =  [
        '1'=> 'سكر',
        '2'=> 'سيراميك',
        '3'=> ' مواد غذائيه',
    ];
    public $add3 =  [
        '1'=> 'سكر',
        '2'=> 'جامبو',
        '3'=> 'شكاير',
    ];
 
    public function statics()
    {
        return view('home.index');
    }
    public function create()
    {

        return view('shiping.create');
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $ship = new Shipping();
            $ship->ship_number = $request->ship_number;
            $ship->client_name = $request->client_name;
            $ship->typeof = $request->typeof;
            $ship->addof = $request->addof;
            $ship->type = $request->type;
            $ship->addtwo = $request->addtwo;
            $ship->addthree = $request->addthree;
            $ship->address = $request->address;
            // $ship->created_at = $request->created_at;
            $ship->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $msg = 'تم انشاء  شحنة رقم  _ ' .  $ship->id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }
    public function indexfinished(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Shipping::select('*')->where('type', $id)->where('status', 2)->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('parentt', function ($row) {
                    $parent = '__';
                    if ($row->typ) {
                        $parent = $row->typ->name ?? " ";
                    }
                    return $parent;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $s = "جاريه";
                    } elseif ($row->status == 2) {
                        $s = "منتهيه";
                    }
                    return $s;
                })
                ->addColumn('action', function ($row) {
                    $edit = route('shiping.edit', $row->id);
                    $show = route('shiping.enterDriver', $row->id);
                    $actionBtn = '<a   href="' . $show . '" class=" m-1 btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '"  class="print btn btn-warning btn-sm"><i class="fas fa-print"></i></a>';
                    // $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '"  class="prices m-1 btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    return $actionBtn;
                })

                ->filter(
                    function ($instance) use ($request) {}
                )
                ->rawColumns(['action', 'parentt', 'status'])
                ->make(true);
        }
        $typeid = $id;
        return view('shiping.index', compact('typeid'));
    }
    public function changestatus(Request $request)
    {
        $data =  Shipping::find($request->id);
        $data->status = 2;
        $data->save();
        return response()->json(['message' => "done", "err" => false], 200);
    }
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Shipping::select('*')->where('type', $id)->where('status', 1)->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('parentt', function ($row) {
                    $parent = '__';
                    if ($row->typ) {
                        $parent = $row->typ->name ?? " ";
                    }
                    return $parent;
                })
                ->addColumn('status', function ($row) {

                    if ($row->status == 1) {
                        $s = "جاريه";
                    } elseif ($row->status == 2) {
                        $s = "منتهيه";
                    }
                    return $s;
                })
                ->addColumn('addtwo', function ($row) {
                    $addtwo = $this->add2[$row->addtwo] ?? " ";
                   
                    return $addtwo;
                })
                ->addColumn('addthree', function ($row) {

                    $addthree = $this->add3[$row->addthree] ?? " ";
                    return $addthree;
                })
                ->addColumn('action', function ($row) {
                    $edit = route('shiping.edit', $row->id);
                    $show = route('shiping.enterDriver', $row->id);
                    $actionBtn = '<a href="' . $edit . '" class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                    $actionBtn .= '<a   href="' . $show . '" class=" m-1 btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="delete btn m-1 btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '"  class="print btn btn-warning btn-sm"><i class="fas fa-print"></i></a>';
                    if ($row->status == 1) {
                        $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="status m-1 btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="status m-1 btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
                    }
                    return $actionBtn;
                })

                ->filter(
                    function ($instance) use ($request) {}
                )
                ->rawColumns(['action', 'parentt', 'status','addtwo','addthree'])
                ->make(true);
        }
        $typeid = $id;
        return view('shiping.index', compact('typeid'));
    }
    public function edit($id)
    {
        $ship = Shipping::find($id);
        return view('shiping.edit', compact('ship'));
    }

    public function update(Request $request)
    {

        DB::beginTransaction();
        try {

            $ship =  Shipping::find($request->id);
            $ship->ship_number = $request->ship_number;
            $ship->client_name = $request->client_name;
            $ship->typeof = $request->typeof;
            $ship->addof = $request->addof;
            $ship->type = $request->type;
            $ship->addtwo = $request->addtwo;
            $ship->addthree = $request->addthree;
            $ship->address = $request->address;
            $ship->created_at = $request->created_at;
            $ship->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $msg = 'تم تعديل  شحنة رقم  _ ' .  $ship->id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }



    public function enterDriver(Request $request, $id)
    {
        $shiping = Shipping::find($id);
        if ($request->ajax()) {
            $data = ShipingDetail::where('shiping_id', $id)->select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('driver', function ($row) {
                    $name = $row->driv->name ?? " ";
                    return $name;
                })
                ->setRowClass(function ($row) {
                    if ($row->residual == 0) {
                        return  'bg-secondary';
                    }
                    return '';
                })
                ->addColumn('action', function ($row) {

                    $show = route('shiping.enterDriver', $row->id);
                    $actionBtn = '<a href="javascript:void(0)"  value="' . $row->id . '" class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" data-target="#exampleModal1" data-toggle="modal" value="' . $row->id . '" class=" m-1 info btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="delete btn m-1 btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '"  class="print2 btn m-1 btn-success btn-sm"><i class="fas fa-truck-moving"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '"  class="print btn btn-warning btn-sm"><i class="fas fa-building"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" data-target="#exampleModalpay" data-toggle="modal" value="' . $row->id . '" class=" m-1 payment btn btn-success btn-sm"><i class="fas fa-money-bill"></i></a>';



                    return $actionBtn;
                })

                ->filter(
                    function ($instance) use ($request) {
                        if ($request->get('driver_id') !== null) {
                            $driver_id = $request->get('driver_id');
                            $instance->where('driver_id',  $driver_id);
                        }
                        if ($request->get('car_number') !== null) {
                            $car_number = $request->get('car_number');
                            $instance->where('car_number',  'LIKE', "%$car_number%");
                        }
                    }
                )
                ->rawColumns(['action', 'driver'])
                ->make(true);
        }
        return view('shiping.enterdriver', compact('shiping'));
    }

    public function storedrivershiping(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {

            if ($request->has('editid')) {
                $data =  ShipingDetail::find($request->editid);
            } else {

                $num =  ShipingDetail::where('shiping_id', $request->shiping_id)->where('car_number', $request->car_number)->first();
                if ($num) {
                    return response()->json(['message' => " رقم السياره مكرر ", 'err' => true], 200);
                }
                $data = new ShipingDetail();
            }
            $data->type_id = $request->type_id;
            $data->shiping_id = $request->shiping_id; // رقم الشخنه 0
            $data->driver_id = $request->driver_id; // سواق 0
            $data->car_number = $request->car_number; // رقم السياره   0
            $data->trailer_number = $request->trailer_number; // المقطوره  0
            $data->charge_date = $request->charge_date; // تاريخ الوصول  0
            $data->charge_datetwo = $request->charge_datetwo; // تاريخ التحميل  0
            $data->charge_between = $request->charge_between; // فرق الوصول  0
            $data->tahmel_between = $request->tahmel_between; // فرق التحميل  0
            $data->decharge_date = $request->decharge_date; // تاريخ التعتيق  0
            $data->nolon = $request->nolon ?? 0;  // نولون  0
            $data->tax = $request->tax ?? 0;    // //  تحميل -- طلعه0
            $data->karta = $request->karta ?? 0; // طرق0
            $data->mizan = $request->mizan ?? 0; // بسكول ميزان0
            $data->kobry = $request->kobry ?? 0; // معديه0
            $data->transfar = $request->transfar ?? 0; // تحويله0
            $data->leaval = $request->leaval ?? 0; // الشرائح0
            $data->goverment = $request->goverment ?? 0; // محافظه0
            $data->enamel_door = $request->enamel_door ?? 0; // باب المينا0
            $data->overnight = $request->overnight ?? 0; // مبيت0
            $data->entry = $request->entry ?? 0; // دخول0
            $data->overnight2 = $request->overnight2 ?? 0; // مبيت هيئه0
            $data->balance_fees = $request->balance_fees ?? 0; // رسوم ميزان 0
            $data->digging = $request->digging ?? 0; // حفر0
            $data->shoaa = $request->shoaa ?? 0; // شعاع0
            $data->tankat = $request->tankat ?? 0; // تحميل تنكات0
            $data->blank_slice = $request->blank_slice ?? 0; // شريحه فارغ0
            $data->full_slice = $request->full_slice ?? 0; // شريحه محمل0
            $data->slice_kopry = $request->slice_kopry ?? 0; // معديه فارغ0
            $data->full_kopry = $request->full_kopry ?? 0; // معديه محمل 0
            $data->entrance_fees = $request->entrance_fees ?? 0; // رسوم ميزان 0
            $data->gard = $request->gard ?? 0; // حراسه0
            $data->totalone = $request->totalone ?? 0; // اجمالى الشركه0
            $data->accommodation = $request->accommodation ?? 0; // مبيت هيئه مندوب0
            $data->covenant = $request->covenant ?? 0; // العهده0
            $data->discount = $request->discount ?? 0; // سلفه0
            $data->due = $request->due ?? 0; //  الصافي
            $data->overnightdriv = $request->overnightdriv ?? 0; //  مبيت السائق
            $data->drivermony = $request->drivermony ?? 0; //  اجالي السائق
            $data->residual = $request->due ?? 0;
            $data->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $msg = 'تم  اضافة سائق للشحنه رقم   _ ' .  $request->shiping_id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }

    public function exportpdf()
    {
        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();
        $data = [];
        $pdf = Pdf::loadView('pdf.shiping', $data);
        return $pdf->download('shiping.pdf');
    }

    public function info(Request $request)
    {
        $data =  ShipingDetail::find($request->id);
        $data->drivername = $data->driv->name ?? "";
        return response()->json(['data' => $data], 200);
    }
    public function infopay(Request $request)
    {
        $data =  ShipingDetail::find($request->id);
        $payments = Payment::where('details_id', $request->id)->get()->sum('amount');

        return response()->json(['data' => $data, 'payments' => $payments], 200);
    }
    public function delete(Request $request)
    {
        $data =  ShipingDetail::find($request->id);
        $data->delete();
        return response()->json(['msg' => "done", "err" => false], 200);
    }
    public function deleteshiping(Request $request)
    {
        $data =  Shipping::find($request->id);
        $data->delete();
        return response()->json(['msg' => "done", "err" => false], 200);
    }
    public function print($id)
    {
        //    dd($id);
        $data = ShipingDetail::find($id);
        // $branch_name = $branche->branch_name;
        return view('pdf.onecar', compact('data'));
    }
    public function printforcompany($id)
    {
        //    dd($id);
        $data = ShipingDetail::find($id);
        // $branch_name = $branche->branch_name;
        return view('shiping.printone', compact('data'));
    }
    public function printfordriver($id)
    {
        //    dd($id);
        $data = ShipingDetail::find($id);
        // dd($data);
        // $branch_name = $branche->branch_name;
        return view('shiping.prfordriver', compact('data'));
    }



    public function editDriver($id)
    {

        $data = ShipingDetail::find($id);
        return response()->json(['data' => $data], 200);
        // if($data->decharge_date == ""){
        //     return response()->json(['data' => $data], 200);

        // }else{
        //     return response()->json(['msg' => "لا يمكن التعديل علي هذا الصف ", "err" => true], 201);
        // }
        // return response()->json(['data' => $data], 200);
    }
    // $pdf = Pdf::loadView('pdf.invoice', $data);
    // return $pdf->download('invoice.pdf');
}

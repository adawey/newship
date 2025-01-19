<?php

namespace App\Http\Controllers;

use App\Exports\CarSum;
use App\Models\Payment;
use App\Models\Shipping;
use App\Exports\CarReport;
use Illuminate\Http\Request;
use App\Models\ShipingDetail;
use App\Models\VendorPayment;
use App\Exports\PaymentReport;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function index()
    {

        return view('reports.index');
    }

    public function statics()
    {

        $shippingDetails = ShipingDetail::whereHas('mainship', function ($query) {
            $query->whereIn('type', [1, 2, 3]); // Fetch records with types 1, 2, or 3
        })
            ->with('mainship') // Eager load the 'mainship' relationship
            ->get()
            ->groupBy(function ($shipingDetail) {
                return $shipingDetail->mainship->type; // Group by the 'type' of the 'mainship' relationship
            });

        return view('home.index', compact('shippingDetails'));
    }

    public function shipnumberReport($id)
    {
        // dd($request->all());
        $shiping = Shipping::where('id', $id)->first();
        $data = ShipingDetail::where('shiping_id', $shiping->id)->select('*')->orderBy('id', 'desc')->get();

        return view('pdf.alldriver', compact('data'));
    }

    public function typereport(Request $request)
    {

        $invs = ShipingDetail::where('type_id', $request->type_id);
        $startDate = $request->from;
        $endDate = $request->to;
        if ($request->type == 1) {
            // تحميل 
            $invs = $invs->whereBetween('charge_date', [$startDate, $endDate]);
        } else {
            // تعتيق
            $invs = $invs->whereBetween('decharge_date', [$startDate, $endDate]);
        }
        $invs = $invs->select('*')->orderBy('id', 'desc')->get();
        foreach ($invs as $in) {
            $in->totalpayment = $in->payments->sum('amount');
        }
        $name = "تقرير حسب النوع" . '.xlsx';
        return Excel::download(new CarReport($invs), $name);
    }


    public function carsnotdecharge(Request $request)
    {

        $invs = ShipingDetail::where('type_id', $request->type_id)->whereNull('decharge_date');
        $startDate = $request->from;
        $endDate = $request->to;
        if ($request->type == 1) {
            // تحميل 
            $invs = $invs->whereBetween('charge_date', [$startDate, $endDate]);
        }
        $invs =  $invs->select('*')->orderBy('id', 'desc')->get();
        foreach ($invs as $in) {
            $in->totalpayment = $in->payments->sum('amount');
        }
        $name = "تقرير من غير تعتيق " . '.xlsx';
        return Excel::download(new CarSum($invs), $name);
    }


    public function carstatus(Request $request)
    {

        $invs = ShipingDetail::where('type_id', $request->type_id);
        if ($request->status == 1) {
            $invs = $invs->where('residual', 0);
        } else {
            $invs = $invs->where('residual', '>', 0);
        }
        $startDate = $request->from;
        $endDate = $request->to;
        if ($request->type == 1) {
            // تحميل 
            $invs = $invs->whereBetween('charge_date', [$startDate, $endDate]);
        } else {
            // تعتيق
            $invs = $invs->whereBetween('decharge_date', [$startDate, $endDate]);
        }
        $invs =  $invs->select('*')->orderBy('id', 'desc')->get();
        foreach ($invs as $in) {
            $in->totalpayment = $in->payments->sum('amount');
        }
        $name = "تقرير حسب الحاله" . '.xlsx';
        return Excel::download(new CarSum($invs), $name);
    }
    public function carnumreport(Request $request)
    {
        $carnum = $request->input('carnum');
        $array = ['ivo' => 'i'];
        $collection =  ShipingDetail::where('car_number', $carnum)->select('*');

        $invs =  $collection->get();
        foreach ($invs as $in) {
            $in->totalpayment = $in->payments->sum('amount');
        }
        // dd($invs);
        $name = "car" . '.xlsx';
        // dd($name);
        return Excel::download(new CarReport($invs), $name);
        // return view('pdf.carnum', compact('invs', 'array'));
    }
    public function shipnumber(Request $request)
    {
        $shipnumberReport = $request->input('shipnumberReport');
        $array = ['ivo' => 'i'];
        $shiping = Shipping::where('ship_number', $shipnumberReport)->first();
        $collection =  ShipingDetail::where('shiping_id', $shiping->id)->select('*');
        // if ($supplier_id !== 'null') {
        //     $collection->where('sub_id', $supplier_id);
        // }
        // if ($from !== 'null') {
        //     $collection->whereDate('date', '>=', $from);
        //     $array['from'] = $from;
        // }
        // if ($to !== 'null') {
        //     $collection->whereDate('date', '<=', $to);
        //     $array['to'] = $to;
        // }
        $invs =  $collection->get();
        foreach ($invs as $in) {
            $in->totalpayment = $in->payments->sum('amount');
        }
        $name = $shiping->typ->name . $shipnumberReport . '.xlsx';

        return Excel::download(new CarReport($invs), $name);

        // return view('pdf.carnum', compact('invs', 'array'));
    }

    public function vendorpaymentsreport(Request $request){
        $startDate = $request->from;
        $endDate = $request->to;
        $addpayments = VendorPayment::where('employee_id', $request->id)->whereBetween('created_at', [$startDate, $endDate])->get();
        foreach($addpayments as $p){
            $p->details_id = 0;
            $p->typepay = "add";
            $p->amount = $p->amount;
            $p->auth_id = "";
        }
        $minpayments = Payment::where('auth_id', $request->id)->whereBetween('created_at', [$startDate, $endDate])->get();
        $mergedPayments = $addpayments->merge($minpayments);
        $sortedPayments = $mergedPayments->sortBy('created_at');
        $sortedPayments = $sortedPayments->values();
        // dd($sortedPayments);
        $invs =  $sortedPayments;
        $name = "دفعات" . '.xlsx';
        return Excel::download(new PaymentReport($invs), $name);

    }
    public function specialoga(Request $request)
    {
        $shipnumberReport = $request->input('shipnum');
        $array = ['ivo' => 'i'];
        
        $shiping = Shipping::where('ship_number', $shipnumberReport)->first();
        $collection =  ShipingDetail::where('shiping_id', $shiping->id)->select('*');
        // if ($supplier_id !== 'null') {
        //     $collection->where('sub_id', $supplier_id);
        // }
        // if ($from !== 'null') {
        //     $collection->whereDate('date', '>=', $from);
        //     $array['from'] = $from;
        // }
        // if ($to !== 'null') {
        //     $collection->whereDate('date', '<=', $to);
        //     $array['to'] = $to;
        // }
        $invs =  $collection->get();
        foreach ($invs as $in) {
            $in->totalpayment = $in->payments->sum('amount');
        }
        $name = "ship" . '.xlsx';

        return Excel::download(new CarReport($invs), $name);

        // return view('pdf.carnum', compact('invs', 'array'));
    }

}

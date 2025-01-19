<?php

namespace App\Http\Controllers\Employee;

use DataTables;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Traits\Media;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    use Media;
    function __construct()
    {
        $this->middleware('permission:show salaries', ['only' => ['index']]);
        $this->middleware('permission:add salaries', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit salaries', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete salaries', ['only' => ['delete']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Salary::latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function ($row) {
                    $emp = $row->employee->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('leader', function ($row) {
                    $emp = $row->leader->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('action', function ($row) {
                    $delete_action = " ";
                    if (!auth()->user()->can('delete salaries'))
                        $delete_action = 'hidden';

                    $actionBtn = '<a href="javascript:void(0)" ' . $delete_action . ' value="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="las la-trash"></i></a>';
                    return $actionBtn;
                })
                ->filter(
                    function ($instance) use ($request) {
                        if (
                            $request->get('from') !== null
                        ) {
                            $from = $request->get('from');
                            $instance->whereDate('date', '>=', "$from");
                        }
                        if ($request->get('to') !== null) {
                            $to = $request->get('to');
                            $instance->whereDate('date', '<=', "$to");
                        }
                        if ($request->get('id') !== null) {
                            $id = $request->get('id');
                            $instance->where('id', $id);
                        }
                        if ($request->get('employee_id') !== null) {
                            $employee_id = $request->get('employee_id');
                            $instance->where('employee_id', "$employee_id");
                        }
                    }
                )
                ->rawColumns(['action', 'leader', 'employee'])
                ->make(true);
        }

        return view('salaries.index');
    }
    public function indextrashed(Request $request)
    {
        if ($request->ajax()) {
            $data = Salary::select('*')->onlyTrashed();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function ($row) {
                    $emp = $row->employee->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('leader', function ($row) {
                    $emp = $row->leader->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('action', function ($row) {
                    $delete_action = " ";
                    if (!auth()->user()->can('delete salaries'))
                        $delete_action = 'hidden';

                    $actionBtn = '<a href="javascript:void(0)" ' . $delete_action . ' value="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="las la-trash"></i></a>';
                    return $actionBtn;
                })
                ->filter(
                    function ($instance) use ($request) {
                        if (
                            $request->get('from') !== null
                        ) {
                            $from = $request->get('from');
                            $instance->whereDate('date', '>=', "$from");
                        }
                        if ($request->get('to') !== null) {
                            $to = $request->get('to');
                            $instance->whereDate('date', '<=', "$to");
                        }
                        if ($request->get('id') !== null) {
                            $id = $request->get('id');
                            $instance->where('id', $id);
                        }
                        if ($request->get('employee_id') !== null) {
                            $employee_id = $request->get('employee_id');
                            $instance->where('employee_id', "$employee_id");
                        }
                    }
                )
                ->rawColumns(['action', 'leader', 'employee'])
                ->make(true);
        }

        return view('salaries.index');
    }


    public function create()
    {
        return view('salaries.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'b_amount' => 'required',
            'employee_id' => 'required',
            'date' => 'required',
            'total' => 'required',
        ], [
            'b_amount.required' => 'من فضلك ادخل قيمة صحيحة',
            'employee_id.required' => ' اختر موظف ',
            'date.required' => 'التاريخ مطلوب',
            'total.required' => ' من فضلك تحقق من المدخلات ',
        ]);
        DB::beginTransaction();
        try {
            $newsalary = new Salary();
            $newsalary->b_amount = $request->b_amount;
            $newsalary->h_allowance = $request->h_allowance;
            $newsalary->t_allowance = $request->t_allowance;
            $newsalary->other = $request->other;
            $newsalary->total = $request->total;
            $newsalary->employee_id = $request->employee_id;
            $newsalary->date = $request->date;
            $newsalary->auth_id = Auth::user()->id;
            $newsalary->note = $request->note;
            $newsalary->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $this->storeLog($newsalary->employee_id, 'اضافة مرتب للموظف رقم ');
        return response()->json(['message' => "done", "err" => false], 200);
    }
    public function delete(Request $request)
    {

        $sa = Salary::find($request->id);
        if (!$sa) {
            return response()->json(['message' => 'هناك خطأ ما', 'err' => true], 200);
        }
        $this->storeLog($sa->employee_id, 'حذف مرتب للموظف رقم ');
        $sa->delete();
        return response()->json(['message' => "done", "err" => false], 200);
    }
}

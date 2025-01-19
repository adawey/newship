<?php

namespace App\Http\Controllers\Employee;

use DataTables;
use App\Models\User;
use App\Models\Reward;
use App\Http\Traits\Media;
use Illuminate\Http\Request;
use App\Exports\RewardExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RewardController extends Controller
{
    use Media;
    function __construct()
    {
        $this->middleware('permission:show rewards', ['only' => ['index']]);
        $this->middleware('permission:add rewards', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit rewards', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete rewards', ['only' => ['delete']]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required',
            'id' => 'required',
            'date' => 'required',
        ], [
            'amount.required' => 'من فضلك ادخل قيمة صحيحة',
            'id.required' => ' هناك خطأ ما من فضلك حدث الصفحة',
            'date.required' => 'التاريخ مطلوب',
        ]);
        DB::beginTransaction();
        try {
            $user = User::findOrfail($request->id);
            if (!$user) {
                return response()->json(['message' => 'هناك خطأ ما', 'err' => true], 200);
            }
            $newDibet = new Reward();
            $newDibet->amount = $request->amount;
            $newDibet->employee_id = $request->id;
            $newDibet->date = $request->date;
            $newDibet->auth_id = Auth::user()->id;
            $newDibet->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $this->storeLog($newDibet->employee_id, 'اضافة مكافأه للموظف رقم ');

        return response()->json(['error' => false, "message" => "created_done"]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Reward::latest();
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
                    $edit_action = '';
                    $delete_action = '';

                    if (!auth()->user()->can('edit rewards'))
                        $edit_action = 'hidden';
                    if (!auth()->user()->can('delete rewards'))
                        $delete_action = 'hidden';

                    $edit = "";
                    $actionBtn = '<a href="' . $edit . '" ' . $edit_action . '  class="edit btn btn-warning btn-sm"><i class="las la-pen"></i></a>
                                  <a href="javascript:void(0)" ' . $delete_action . ' value="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="las la-trash"></i></a>';
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

        return view('rewards.index');
    }
    public function indextrashed(Request $request)
    {
        if ($request->ajax()) {
            $data = Reward::select('*')->onlyTrashed();
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
                    $edit_action = '';
                    $delete_action = '';

                    if (!auth()->user()->can('edit rewards'))
                        $edit_action = 'hidden';
                    if (!auth()->user()->can('delete rewards'))
                        $delete_action = 'hidden';

                    $edit = "";
                    $actionBtn = '<a href="' . $edit . '" ' . $edit_action . '  class="edit btn btn-warning btn-sm"><i class="las la-pen"></i></a>
                                  <a href="javascript:void(0)" ' . $delete_action . ' value="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="las la-trash"></i></a>';
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

        return view('rewards.index');
    }
    public function delete(Request $request)
    {
        $re = Reward::find($request->id);
        if (!$re) {
            return response()->json(['message' => 'هناك خطأ ما', 'err' => true], 200);
        }
        $this->storeLog($re->employee_id, 'حذف مكافأه للموظف رقم ');
        $re->delete();
        return response()->json(['error' => false, "message" => "deleted done"]);
    }

    public function exportexel(Request $request)
    {
        $employee_id = $request->input('employee_id');
        $from = $request->input('from');
        $to = $request->input('to');

        $rewards = Reward::select('*')->orderBy('id', 'desc');
        if ($employee_id !== null) {
            $rewards->where('employee_id', $employee_id);
        }
        if ($from !== null) {
            $rewards->whereDate('date', '>=', $from);
        }
        if ($to !== null) {
            $rewards->whereDate('date', '<=', $to);
        }
        $rewards =  $rewards->get();
        $name = 'rewards' . '.xlsx';
        // dd($name);
        return Excel::download(new RewardExport($rewards), $name);
    }
}

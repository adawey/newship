<?php

namespace App\Http\Controllers\Employee;

use DataTables;
use App\Models\Discount;
use App\Http\Traits\Media;
use Illuminate\Http\Request;
use App\Exports\DiscountExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DiscountController extends Controller
{
    use Media;
    function __construct()
    {
        $this->middleware('permission:show discount', ['only' => ['index']]);
        $this->middleware('permission:add discount', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit discount', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete discount', ['only' => ['delete']]);
    }

    public function storedebit(Request $request)
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
            $new = new Discount();
            $new->amount = $request->amount;
            $new->employee_id = $request->id;
            $new->date = $request->date;
            $new->type = 0;
            $new->auth_id = Auth()->user()->id;
            $new->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $this->storeLog($new->employee_id, 'اضافة سلفه للموظف رقم ');
        return response()->json(['error' => false, "message" => "created_done"]);
    }

    public function storediscount(Request $request)
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
            $new = new Discount();
            $new->amount = $request->amount;
            $new->employee_id = $request->id;
            $new->date = $request->date;
            $new->type = 1;
            $new->auth_id = Auth()->user()->id;
            $new->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $this->storeLog($new->employee_id, 'اضافة خصم للموظف رقم ');
        return response()->json(['error' => false, "message" => "created_done"]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Discount::latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function ($row) {
                    $emp = $row->employee->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('typee', function ($row) {
                    if ($row->type == "1") {
                        $ty = "خصم";
                    } else {
                        $ty = "سلفة";
                    }
                    return $ty;
                })
                ->addColumn('leader', function ($row) {
                    $emp = $row->leader->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('action', function ($row) {

                    $edit_action = '';
                    $delete_action = '';

                    if (!auth()->user()->can('edit discount'))
                        $edit_action = 'hidden';
                    if (!auth()->user()->can('delete discount'))
                        $delete_action = 'hidden';

                    $edit = "";
                    $actionBtn = '<a href="' . $edit . '" ' . $edit_action . ' class="edit btn btn-warning btn-sm"><i class="las la-pen"></i></a>
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
                ->rawColumns(['action', 'leader', 'typee', 'employee'])
                ->make(true);
        }

        return view('discount.index');
    }
    public function indextrashed(Request $request)
    {
        if ($request->ajax()) {
            $data = Discount::select('*')->onlyTrashed();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function ($row) {
                    $emp = $row->employee->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('typee', function ($row) {
                    if ($row->type == "1") {
                        $ty = "خصم";
                    } else {
                        $ty = "سلفة";
                    }
                    return $ty;
                })
                ->addColumn('leader', function ($row) {
                    $emp = $row->leader->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('action', function ($row) {

                    $edit_action = '';
                    $delete_action = '';

                    if (!auth()->user()->can('edit discount'))
                        $edit_action = 'hidden';
                    if (!auth()->user()->can('delete discount'))
                        $delete_action = 'hidden';

                    $edit = "";
                    $actionBtn = '<a href="' . $edit . '" ' . $edit_action . ' class="edit btn btn-warning btn-sm"><i class="las la-pen"></i></a>
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
                ->rawColumns(['action', 'leader', 'typee', 'employee'])
                ->make(true);
        }

        return view('discount.index');
    }
    public function delete(Request $request)
    {
        $dis = Discount::find($request->id);
        if (!$dis) {
            return response()->json(['message' => 'هناك خطأ ما', 'err' => true], 200);
        }
        if ($dis->type == 1) {
            $this->storeLog($dis->employee_id, 'حذف خصم للموظف رقم ');
        } else {
            $this->storeLog($dis->employee_id, 'حذف سلفه للموظف رقم ');
        }
        $dis->delete();
        return response()->json(['error' => false, "message" => "deleted done"]);
    }

    public function exportexel(Request $request)
    {
        $employee_id = $request->input('employee_id');
        $from = $request->input('from');
        $to = $request->input('to');
        $type = $request->input('type');

        $discounts = Discount::select('*')->orderBy('id', 'desc');
        if ($employee_id !== null) {
            $discounts->where('employee_id', $employee_id);
        }
        if ($from !== null) {
            $discounts->whereDate('date', '>=', $from);
        }
        if ($type !== null) {
            $discounts->where('type', $type);
        }
        if ($to !== null) {
            $discounts->whereDate('date', '<=', $to);
        }
        $discounts =  $discounts->get();
        $name = 'discounts' . '.xlsx';
        // dd($name);
        return Excel::download(new DiscountExport($discounts), $name);
    }
}

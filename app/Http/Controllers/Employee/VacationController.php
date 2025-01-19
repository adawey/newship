<?php

namespace App\Http\Controllers\Employee;

use DataTables;
use App\Models\Vacation;
use App\Http\Traits\Media;
use Illuminate\Http\Request;
use App\Exports\VacationExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VacationController extends Controller
{

    use Media;


    function __construct()
    {
        $this->middleware('permission:show vacations', ['only' => ['index']]);
        $this->middleware('permission:add vacations', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit vacations', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete vacations', ['only' => ['delete']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vacation::latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function ($row) {
                    $emp = $row->employee->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('attach', function ($row) {
                    $attach  =  url('/') . '/images/vacation/' . $row->attachment ?? " ";
                    $actionBtn = '<a target="_blank" href="' . $attach . '" class="attach btn btn-warning btn-sm"> عرض </a>';
                    return $actionBtn;
                })
                ->addColumn('action', function ($row) {
                    $edit_action = '';
                    $delete_action = '';

                    if (!auth()->user()->can('edit vacations'))
                        $edit_action = 'hidden';
                    if (!auth()->user()->can('delete vacations'))
                        $delete_action = 'hidden';

                    $edit = "";
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
                        if ($request->get('employee_id') !== null) {
                            $employee_id = $request->get('employee_id');
                            $instance->where('employee_id', "$employee_id");
                        }
                    }
                )
                ->rawColumns(['action', 'attach', 'employee'])
                ->make(true);
        }

        return view('vacations.index');
    }


    public function create()
    {
        return view('vacations.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'date' => 'required',
        ], [
            'user_id.required' => ' اختر موظف ',
            'date.required' => 'التاريخ مطلوب',
        ]);
        DB::beginTransaction();
        try {

            $vac = new Vacation();
            $vac->employee_id = $request->user_id;
            $vac->auth_id =  Auth::user()->id;
            $vac->date =  $request->date;
            if ($request->has('attachment')) {
                $attachment = $this->uploadMedia($request->attachment, 'vacation');
                $vac->attachement = $attachment;
            }
            $vac->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $this->storeLog($vac->employee_id, 'اضافة اجازه للموظف رقم ');
        return response()->json(['err' => false, 'message' => "done"]);
    }
    public function delete(Request $request)
    {

        $vac = Vacation::find($request->id);
        if (!$vac) {
            return response()->json(['message' => 'هناك خطأ ما', 'err' => true], 200);
        }
        $this->storeLog($vac->employee_id, 'حذف اجازه للموظف رقم ');
        $vac->delete();
        return response()->json(['err' => false, 'message' => "done"]);
    }

    public function edit($id)
    {
        $vac =  Vacation::find($id);
        return view('vacations.edit', compact('vac'));
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'date' => 'required',
        ], [
            'user_id.required' => ' اختر موظف ',
            'date.required' => 'التاريخ مطلوب',
        ]);
        DB::beginTransaction();
        try {
            $vac = Vacation::find($request->id);
            $vac->employee_id = $request->user_id;
            $vac->auth_id =  Auth::user()->id;
            $vac->date =  $request->date;
            if ($request->has('attachment')) {
                $attachment = $this->uploadMedia($request->attachment, 'vacation');
                $vac->attachement = $attachment;
            }
            $vac->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $this->storeLog($vac->employee_id, 'تعديل اجازه للموظف رقم ');
        return response()->json(['err' => false, 'message' => "done"]);
    }

    public function exportexel(Request $request)
    {
        $employee_id = $request->input('employee_id');
        $from = $request->input('from');
        $to = $request->input('to');

        $vacations = Vacation::select('*')->orderBy('id', 'desc');
        if ($employee_id !== null) {
            $vacations->where('employee_id', $employee_id);
        }
        if ($from !== null) {
            $vacations->whereDate('date', '>=', $from);
        }
        if ($to !== null) {
            $vacations->whereDate('date', '<=', $to);
        }
        $vacations =  $vacations->get();
        $name = 'vacations' . '.xlsx';
        // dd($name);
        return Excel::download(new VacationExport($vacations), $name);
    }
    public function indextrashed(Request $request)
    {
        if ($request->ajax()) {
            $data = Vacation::select('*')->onlyTrashed();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function ($row) {
                    $emp = $row->employee->name ?? 'تم حذفه';
                    return $emp;
                })
                ->addColumn('attach', function ($row) {
                    $attach  =  url('/') . '/images/vacation/' . $row->attachment ?? " ";
                    $actionBtn = '<a target="_blank" href="' . $attach . '" class="attach btn btn-warning btn-sm"> عرض </a>';
                    return $actionBtn;
                })
                ->addColumn('action', function ($row) {
                    $edit_action = '';
                    $delete_action = '';

                    if (!auth()->user()->can('edit vacations'))
                        $edit_action = 'hidden';
                    if (!auth()->user()->can('delete vacations'))
                        $delete_action = 'hidden';

                    $edit = "";
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
                        if ($request->get('employee_id') !== null) {
                            $employee_id = $request->get('employee_id');
                            $instance->where('employee_id', "$employee_id");
                        }
                    }
                )
                ->rawColumns(['action', 'attach', 'employee'])
                ->make(true);
        }

        return view('vacations.indextrashed');
    }
    public function destroy(Request $request)
    {
        DB::table('vacations')->where('id', $request->id)->delete();
        return response()->json(['err' => false, 'msg' => '  تم الحذف بنجاح']);
    }

    public function restore(Request $request)
    {
        $code = Vacation::onlyTrashed()->find($request->id);
        $code->restore();
        return response()->json(['err' => false, 'msg' => 'تم الاسترجاع بنجاح ']);
    }
}

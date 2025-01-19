<?php

namespace App\Http\Controllers\Employee;

use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Traits\Media;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\VendorPayment;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Traits\HasRoles;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class EmployeeController extends Controller
{
    use Media, HasRoles;
    // function __construct()
    // {
    //     $this->middleware('permission:show employee', ['only' => ['index', 'indexdataentry']]);
    //     $this->middleware('permission:add employee', ['only' => ['create', 'store', 'createdataentry']]);
    //     $this->middleware('permission:edit employee', ['only' => ['edit', 'update', 'editdataentry']]);
    //     $this->middleware('permission:delete employee', ['only' => ['delete']]);
    // }



    public function create()
    {
        $roles = Role::all();
        return view('employees.create', compact('roles'));
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view('employees.edit', compact('user', 'roles'));
    }


    public function store(Request $request)
    {
        if ($request->type == 1) {
            // مدخل بيانات
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ], [
                'name.required' => 'لايمكن حفظ اسم الموظف  فارغاً',
                'email.required' => '   لا يمكن ترك   ايميل الموظف فارغ   ',
                'password.required' => 'الباسورد مطلوب',
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required',
                'phone' => 'required',
            ], [
                'name.required' => 'لايمكن حفظ اسم الموظف  فارغاً',
                'phone.required' => '   لا يمكن ترك رقم الجوال فارغ     ',
            ]);
        }

        DB::beginTransaction();
        try {
            $employee = new User();
            $employee->name = $request->name;
            $employee->type = '0';
            $employee->email = $request->email;
            if ($request->type == 1) {
                $employee->password  = $request->password;
                $employee->type = '1';
            }
            if ($request->has('accommodation')) {
                $accommodation = $this->uploadMedia($request->accommodation, 'users');
                $employee->accommodation = $accommodation;
            }
            if ($request->has('passporst')) {
                $passpor = $this->uploadMedia($request->passporst, 'users');
                $employee->passporst = $passpor;
            }
            $employee->phone = $request->phone ?? null;
            $employee->location = $request->location ?? null;
            $employee->created_by =  Auth()->user()->id;
            $employee->save();
            $employee->roles()->sync($request->input('role_id'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        if ($request->type == 1) {
            $this->storeLog($employee->id, 'تم انشاء موظف مدخل بيانات رقم ');
        } else {
            $this->storeLog($employee->id, 'تم انشاء موظف   رقم ');
        }

        return response()->json(['error' => false, "message" => "created_done"]);
    }
    public function update(Request $request)
    {
        if ($request->type == 1) {
            // مدخل بيانات
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
            ], [
                'name.required' => 'لايمكن حفظ اسم الموظف  فارغاً',
                'email.required' => '   لا يمكن ترك   ايميل الموظف فارغ   ',
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required',
                'phone' => 'required',
            ], [
                'name.required' => 'لايمكن حفظ اسم الموظف  فارغاً',
                'phone.required' => '   لا يمكن ترك رقم الجوال فارغ     ',
            ]);
        }
        DB::beginTransaction();
        try {
            $employee = User::find($request->id);
            if ($request->has('passporst')) {
                $passpor = $this->uploadMedia($request->passporst, 'users');
                $employee->passporst = $passpor;
            }
            if ($request->has('accommodation')) {
                $accommodation = $this->uploadMedia($request->accommodation, 'users');
                $employee->accommodation = $accommodation;
            }
            $employee->name = $request->name;
            $employee->type = '0';
            $employee->email = $request->email;
            $employee->location = $request->location;
            if ($request->type == 1) {
                if ($request->password) {
                    $employee->password = $request->password;
                }
                $employee->type = '1';
            }
            $employee->phone = $request->phone;
            $employee->save();
            $employee->roles()->sync($request->input('role_id'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        if ($request->type == 1) {
            $this->storeLog($employee->id, 'تم تعديل موظف مدخل بيانات رقم ');
        } else {
            $this->storeLog($employee->id, 'تم تعديل موظف   رقم ');
        }

        return response()->json(['error' => false, "message" => "updated_done"]);
    }
    public function delete(Request $request)
    {

        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['message' => 'هناك خطأ ما', 'err' => true], 200);
        }
        if ($user->type == 1) {
            $this->storeLog($user->id, 'تم حذف موظف مدخل بيانات رقم ');
        } else {
            $this->storeLog($user->id, 'تم حذف موظف   رقم ');
        }
        $user->delete();
        return response()->json(['error' => false, "message" => "created_done"]);
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::where('type', '0')->select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_byy', function ($row) {
                    $created_by = $row->createdd->name ?? "";
                    return $created_by;
                })
                ->addColumn('action', function ($row) {

                    $edit_action = '';
                    $delete_action = '';


                    // if (!auth()->user()->can('edit employee'))
                    //     $edit_action = 'hidden';
                    // if (!auth()->user()->can('delete employee'))
                    //     $delete_action = 'hidden';

                    $edit = route('employees.edit', $row->id);
                    $actionBtn = '<a href="' . $edit . '"  ' . $edit_action . ' class="edit m-1 btn btn-success btn-sm"> تعديل  </a>';
                    $actionBtn .= '<a href="javascript:void(0)" ' . $delete_action . ' value="' . $row->id . '" class="delete m-1 btn btn-danger btn-sm"> حذف </a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="mony m-1 btn btn-info btn-sm"> اضافة سلفة  </a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="discount m-1 btn btn-secondary btn-sm"> اضافة خصم  </a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="mony2 m-1 btn btn-success btn-sm"> اضافة حافز او مكافأه  </a>';
                    $info = "";

                    $actionBtn .= '<a href="' . $info . '" value="' . $row->id . '" class=" m-1 btn btn-warning btn-sm"> عرض بيانات الموظف  </a>';

                    return $actionBtn;
                })
                ->filter(
                    function ($instance) use ($request) {
                        if ($request->get('name') !== null) {
                            $type = $request->get('type');
                            $instance->where('type',  $type);
                        }
                        if (
                            $request->get('email') !== null
                        ) {
                            $from = $request->get('from');
                            $instance->whereDate('invoice_date', '>=', "$from");
                        }
                        if ($request->get('phone') !== null) {
                            $to = $request->get('to');
                            $instance->whereDate('invoice_date', '<=', "$to");
                        }
                        if ($request->get('location') !== null) {
                            $to = $request->get('to');
                            $instance->whereDate('invoice_date', '<=', "$to");
                        }
                    }
                )
                ->rawColumns(['action', 'created_byy'])
                ->make(true);
        }
        $roles = Role::all();
        return view('employees.employees', 'compact'('roles'));
    }

    public function indexdataentry(Request $request)
    {

        if ($request->ajax()) {
            $data = User::where('type', '1')->select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('rolle', function ($row) {
                    $rolle = $row->roles[0]->name ?? "";
                    return $rolle;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $s = '<a href="javascript:void(0)" value="' . $row->id . '" class="status m-1 btn btn-info btn-sm"><i class="fas fa-lock-open"></i></a>';
                    } else {
                        $s = '<a href="javascript:void(0)" value="' . $row->id . '" class="status m-1 btn btn-info btn-sm"><i class="fas fa-lock"></i></a>';
                    }
                    return $s;
                })
                ->addColumn('action', function ($row) {
                    $edit_action = '';
                    $delete_action = '';
                    // if (!auth()->user()->can('edit employee'))
                    //     $edit_action = 'hidden';
                    // if (!auth()->user()->can('delete employee'))
                    //     $delete_action = 'hidden';

                    $edit = route('employees.dataentry.edit', $row->id);
                    $actionBtn = '<a href="' . $edit . '" ' . $edit_action . ' class="edit m-1 btn btn-success btn-sm"><i class="las la-pen"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" ' . $delete_action . ' value="' . $row->id . '" class="delete m-1 btn btn-danger btn-sm"><i class="las la-trash"></i></a>';
                    $actionBtn .= '<a href="javascript:void(0)" value="' . $row->id . '" class="mony m-1 btn btn-info btn-sm"><i style="color:white" class="fas fa-plus"></i></a>';

                    return $actionBtn;
                })
                ->rawColumns(['action', 'rolle','status'])
                ->make(true);
        }
        return view('dataentry.index');
    }

    public function editdataentry($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view('dataentry.edit', compact('roles', 'user'));
    }

    public function createdataentry()
    {
        $roles = Role::all();
        return view('dataentry.create', compact('roles'));
    }

    public function exportemployee(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $users = User::where('type', '0')->select('*')->orderBy('id', 'desc');
        if ($name !== null) {
            $users->where('name', $name);
        }
        if ($email !== null) {
            $users->where('email', $email);
        }
        if ($phone !== null) {
            $users->where('phone', $phone);
        }
        $userss =  $users->get();
        $name = $userss . '.xlsx';
        // dd($name);
        return Excel::download(new UsersExport($userss), $name);
    }


    public function indexdatainttrashed(Request $request)
    {

        if ($request->ajax()) {
            $data = User::where('type', '1')->select('*')->onlyTrashed();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('rolle', function ($row) {
                    $rolle = $row->roles[0]->name ?? "";
                    return $rolle;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)"  value="' . $row->id . '" class="restart btn btn-warning btn-sm"><i class="fas fa-history"></i></a>
                                  <a href="javascript:void(0)"  value="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="las la-trash"></i></a>';
                    return $actionBtn;
                })

                ->rawColumns(['action', 'created_byy'])
                ->make(true);
        }

        return view('dataentry.trashed');
    }

    public function indexemployeetrashed(Request $request)
    {

        if ($request->ajax()) {
            $data = User::where('type', '0')->select('*')->onlyTrashed();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('rolle', function ($row) {
                    $rolle = $row->roles[0]->name ?? "";
                    return $rolle;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)"  value="' . $row->id . '" class="restart btn btn-warning btn-sm"><i class="fas fa-history"></i></a>
                    <a href="javascript:void(0)"  value="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="las la-trash"></i></a>';
                    return $actionBtn;
                })

                ->rawColumns(['action', 'created_byy'])
                ->make(true);
        }

        return view('employees.trashed');
    }

    public function destroy(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        return response()->json(['err' => false, 'message' => '  تم الحذف بنجاح']);
    }

    public function restore(Request $request)
    {
        $code = User::onlyTrashed()->find($request->id);
        $code->restore();
        return response()->json(['err' => false, 'message' => 'تم الاسترجاع بنجاح ']);
    }

    public function addbalance(Request $request){
        $user = DB::table('users')->where('id', $request->id)->first();
        $curentBalance  = $user->balance;
        $amount = $request->amount;
        $addbalance = $amount;
        $newamount = $curentBalance + $addbalance;
        DB::table('users')
        ->where('id', $user->id)
            ->update(['balance' => $newamount]);
        $payment = new VendorPayment();
        $payment->employee_id = $user->id;
        $payment->auth_id = Auth()->user()->id;
        $payment->amount = $amount;
        $payment->balance_after = $newamount;
        $payment->balance_before = $curentBalance;
        $payment->save();
        return response()->json(['err' => false, 'message' => 'جارى طباعة الايصال' , 'id'=>$payment->id ]);

    }
    public function status(Request $request)
    {
        $user = User::find($request->id);
        if ($user->status == 1) {
            $user->status = 0;
        } else {
            $user->status = 1;
        }
        $user->save();
        return response()->json(['error' => false, "message" => "done"]);
    }
}

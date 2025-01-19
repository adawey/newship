<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    //

    // function __construct()
    // {
    //     // $this->middleware('permission:show roles', ['only' => ['index']]);
    //     $this->middleware('permission:add roles', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit roles', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete roles', ['only' => ['delete']]);
    // }

    // public function set(Request $request){

    //     $permissions = new Permission();
    //     $permission->name = $
    // }

    public function create()
    {
        $permissions = Permission::get();

        $groupedItems = [];

        foreach ($permissions as $item) {
            $words = explode(' ', $item->name);
            if (count($words) >= 2) {
                $key = $words[1];

                if (!isset($groupedItems[$key])) {
                    $groupedItems[$key] = [];
                }

                $groupedItems[$key][] = $item;
            }
        }

        return view('roles.create', compact('groupedItems'));
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $edit_action = '';
                    $delete_action = '';

                    if (!auth()->user()->can('edit roles'))
                        $edit_action = 'hidden';
                    if (!auth()->user()->can('delete roles'))
                        $delete_action = 'hidden';

                    $edit = route('roles.edit', $row->id);
                    $actionBtn = '<a href="' . $edit . '" ' . $edit_action . ' class="edit btn btn-warning btn-sm"><i class="las la-pen"></i></a>
                                  <a href="javascript:void(0)" ' . $delete_action . ' value="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="las la-trash"></i></a>';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('roles.index');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'اسم الصلاحيه مطلوب ',
        ]);
        DB::beginTransaction();
        try {

            $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);

            $permissionIds = $request->input('permission');
            $permissions = Permission::whereIn('id', $permissionIds)->get();

            if (count($permissions) == count($permissionIds)) {
                // Handle the case where some permissions are not found
                $role->syncPermissions($permissions);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $msg = 'تم انشاء صلاحية   رقم' .  $role->id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::where('guard_name', 'web')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->get();

        $groupedItems = [];

        foreach ($permission as $item) {
            $words = explode(' ', $item->name);
            if (count($words) >= 2) {
                $key = $words[1];

                if (!isset($groupedItems[$key])) {
                    $groupedItems[$key] = [];
                }

                $groupedItems[$key][] = $item;
            }
        }

        return view('roles.edit', compact('role', 'rolePermissions', 'groupedItems'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'اسم الصلاحيه مطلوب ',
        ]);
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();

            $permissionIds = $request->input('permission');

            if (empty($permissionIds)) {
                // If $permissionIds is empty, remove all permissions from the role
                $role->syncPermissions([]);
            } else {
                // If $permissionIds is not empty, proceed with updating permissions
                $permissions = Permission::whereIn('id', $permissionIds)->get();

                if ($permissions !== null && count($permissions) == count($permissionIds)) {
                    // Handle the case where some permissions are not found
                    $role->syncPermissions($permissions);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'err' => true], 200);
        }
        DB::commit();
        $msg = 'تم تعديل صلاحية   رقم' .  $role->id;
        DB::table('logs')->insert(['user_id' =>  Auth()->user()->id, 'action' => $msg]);
        return response()->json(['message' => "done", "err" => false], 200);
    }

    public function delete(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['error' => true, "message" => "هناك خطأ ما"]);
        }
        $role->delete();
        return response()->json(['message' => "done", "err" => false], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class SubAdminController extends Controller
{
    public function roles(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            $roles = Role::paginate(5);
            return view('subadmin.roles', compact('roles'));
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
    public function editRole(Request $request, $id)
    {
        if ($request->session()->has('admin_id')) {
            $role = Role::find($id);
            if ($request->isMethod('PUT')) {
                $validate = $request->validate([
                    'name' => 'required|string'
                ]);
                $role->name = $request->name;
                $role->save();
                return redirect()->route('roles')->with('success', "$request->name Role updated successfully");
            } else {

                return view('subadmin.editRole', compact('role'));
            }
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
    public function addRoles(Request $request)
    {
        if ($request->session()->has('admin_id')) {

            if ($request->isMethod('POST')) {
                $validate = $request->validate([
                    'name' => 'required|string'
                ]);
                $role = new Role;
                $role->name = $request->name;
                $role->save();
                return redirect()->route('roles')->with('success', "$request->name Role added successfully");
            }
            return view('subadmin.addRoles');
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
    public function permission(Request $request, $id)
    {
        if ($request->session()->has('admin_id')) {

            $role = Role::with('permissions')->find($id);
            // return $role;
            return view('subadmin.permission', compact('role'));
        } else {
            return view('admin.dashboard')->with('danger', 'First login please');
        }
    }
    public function permissionchangestatus(Request $request, $id)
    {
        if ($request->session()->has('admin_id')) {

            if ($request->isMethod('POST')) {


                foreach ($request->all() as $key => $value) {
                    if ($key == '_token') {
                        continue;    // skip token

                    } else {

                        $permission = Permission::where('role_id', $id)->where('name', $key)->first();
                        if ($permission != null) {

                            $permission->name = $key;
                            // return $value;
                            $permission->view = isset($value['view']) ? 1 : 0;
                            $permission->active = isset($value['active']) ? 1 : 0;
                            $permission->create = isset($value['create']) ? 1 : 0;
                            $permission->edit = isset($value['edit']) ? 1 : 0;
                            $permission->save();

                        } else {
                            $permission = new Permission;
                            $permission->name = $key;
                            $permission->role_id = $id;
                            $permission->view = isset($value['view']) ? 1 : 0;
                            $permission->active = isset($value['active']) ? 1 : 0;
                            $permission->create = isset($value['create']) ? 1 : 0;
                            $permission->edit = isset($value['edit']) ? 1 : 0;
                            $permission->save();


                        }
                    }
                }

                return back()->with('success', 'Permission updated successfully');


            } else {
                return view('admin.dashboard')->with('danger', 'First login please');
            }
        }
    }
}
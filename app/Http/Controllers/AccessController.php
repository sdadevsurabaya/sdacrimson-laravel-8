<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Access_model;
use App\Models\Role_model;
use Spatie\Permission\Models\Permission;
use Validator;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accesss = Access_model::
            join("roles","roles.id","=","role_has_permissions.role_id")
            ->groupBy('roles.id')
            ->get(['*', 'roles.id as roles_id', 'roles.name as roles_name']);

        $roles = Role_model::all();
        $permissions = Permission::all();

        // $access = Access_model::orderBy('id', 'DESC')->paginate(10);
        return view('access.index', compact('accesss', 'roles', 'permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role'   => 'required',
            'permission'   => 'required',
        ]);

        if ($validator->passes()) {

            foreach ($request->input('permission') as $key2 => $data) {
                $AccessPermission = Access_model::create([
                    'permission_id'   => $data,
                    'role_id'    => $request->role,
                ]);
            }

           return response()->json(['success'=>'Added new records Access Permission.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $AccessPermission = Access_model::where('role_id', $id)->groupBy('roles.id');
        $RoleAccessPermission = Role_model::where('id', $id)->first();

        $AccessPermission = Access_model::
        join("permissions","permissions.id","=","role_has_permissions.permission_id")
        ->where('role_id', $id)
        // ->groupBy('roles.id')
        ->get();

        $Permissions = Permission::all();

        // return response()->json([
        //     'success' => true,
        //     'data'    => $RoleAccessPermission
        // ]);

        return view('access.edit', compact('RoleAccessPermission', 'AccessPermission', 'Permissions'));
    }

    public function showRole($id)
    {
        $RoleAccessPermission = Role_model::where('id', $id)->first();

        // $AccessPermission = Access_model::
        // join("permissions","permissions.id","=","role_has_permissions.permission_id")
        // ->where('role_id', $id)
        // // ->groupBy('roles.id')
        // ->get();

        // $Permissions = Permission::all();

        return response()->json([
            'success' => true,
            'data'    => $RoleAccessPermission
        ]);

    }

    public function showPermission($id)
    {
        // $AccessPermission = Access_model::where('role_id', $id)->groupBy('roles.id');
        $AccessPermission = Access_model::
        join("permissions","permissions.id","=","role_has_permissions.permission_id")
        ->where('role_id', $id)
        // ->groupBy('roles.id')
        ->get();

        // return response()->json([
        //     'success' => true,
        //     'data'    => $AccessPermission
        // ]);

        for ($h=0; $h < count($AccessPermission) ; $h++) {
            $FixAccessPermission = $AccessPermission[$h]->name;
            // dump($FixAccessPermission);
        }

        // foreach ( $AccessPermission as $key => $data){
        //     $FixAccessPermission = $data->name;
        // }

        $Permissions = Permission::all();

        for ($i=0; $i < count($Permissions) ; $i++) {
            echo '<input type="checkbox" id="permission'.$i.'" name="permission[]" value="'.$Permissions[$i]->id.'" '.($Permissions[$i]->name == $FixAccessPermission ?  "checked" : "").' >
            <label for="permission'.$i.'">'.$Permissions[$i]->name.'</label> <br/>';
        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Access_model::where('role_id', $id)->delete();
        return response()->json(['success'=>'Success Delete records Access Permission.']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;

class UserManagementController extends Controller
{
    // view
    public function index()
    {
        $data = User::all();
        return view('usermanagement.userrole',compact('data'));
    }

    // update 
    public function update(Request $request)
    {

        $update = [

            'id'            =>$request->id,
            'name'          =>$request->name,
            'email'         =>$request->email,
            'phone_number'  =>$request->phone_number,
            'status'        =>$request->status,
            'role_name'     =>$request->role_name
        ];
        User::where('id',$request->id)->update($update);
        return redirect()->back()->with('update','Users Update Success.');
    }
    public function delete($id)
    {
        $delete = User::find($id);
        $delete->delete();
        return redirect()->back()->with('update','Data deleted successfully!');
    }

}

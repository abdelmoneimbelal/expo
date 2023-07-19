<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Form;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;


class FormController extends Controller
{
    // form view
    public function index()
    {
        $data = User::all();
        return view('form.form',compact('data'));
    }
    public function save(Request $request){

        $id            = $request->id;
        $name          = $request->name;
        $company       = $request->company;
        $notes       = $request->notes;
        $email         = $request->email;
        $sex           = $request->sex;
        $country       = $request->country;
        $phone         = $request->phone;
        $facebook_name = $request->facebook_name;
        $youtube_name  = $request->youtube_name;

        $generator = Helper::IDGenerator(new Form,'rec_id',5,'KHS');
        $insert = Form::firstOrNew(['id'=>$id]); // if name = name in database exit

           $insert->rec_id         = $generator;
            $insert->name          = $name;
            $insert->company       = $company;
            $insert->notes         = $notes;
            $insert->email         = $email;
            $insert->sex           = $sex;
            $insert->country       = $country;
            $insert->phone         = $phone;
            $insert->facebook_name = $facebook_name;
            $insert->youtube_name  = $youtube_name;
            $insert->save();
            return redirect()->back()->with('insert','Data insert success.');

    }

    // view report
    public function viewReport()
    {
        $data = Form::all();
        return view('report.report',compact('data'));
    }

    // view update
    public function viewUpdate($id)
    {
        $data = Form::all()->where('id',$id);
        foreach($data as $datas)
        return view('report.report_edit',compact('datas'));
    }

    // delete data from db
    public function delete($id)
    {
        $delete = Form::find($id);
        $delete->delete();
        return redirect()->back()->with('update','Data deleted successfully!');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Vthreeemployee;
use DB;

class CrudVersionThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Vthreeemployee::all();
        return view('crudV3/home', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('crudV3/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'user_name' => 'required',
            'email' => 'required|unique:vthreeemployees',
            'phone' => 'required|unique:vthreeemployees',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $employee = new Vthreeemployee;
        $employee->user_name = $request->user_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->category_id = $request->category_id;
        // return response()->json($employee);

        $image = $request->file('image');

        if($image) {
            $image_name = hexdec(uniqid());
            $extension = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$extension;
            $upload_path = 'public/assets/v3.0/image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $employee->image = $image_url;

            $employee->save();

            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully inserted',
                'alert-type' => 'success'
            );
            return Redirect()->to('/crud-v3')->with($notification);
        }
        else {
            $employee->save();

            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully inserted',
                'alert-type' => 'success'
            );
            return Redirect()->to('/crud-v3')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singleData = DB::table('vthreeemployees')
                    ->join('categories', 'vthreeemployees.category_id', 'categories.id')
                    ->select('vthreeemployees.*', 'categories.name')
                    ->where('vthreeemployees.id', $id)
                    ->first();
        return view('crudV3/singleView', compact('singleData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = DB::table('categories')->get();
        $data = DB::table('vthreeemployees')
                ->join('categories', 'vthreeemployees.category_id', 'categories.id')
                ->select('vthreeemployees.*', 'categories.name')
                ->where('vthreeemployees.id', $id)
                ->first();
        return view('crudV3/edit', compact('categories', 'data'));
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
        $validate = $request->validate([
            'user_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $employee = Vthreeemployee::findorfail($id);
        $employee->user_name = $request->user_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->category_id = $request->category_id;

        $image = $request->file('image');
        if($image) {
            $image_name = hexdec(uniqid());
            $extension = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$extension;
            $upload_path = 'public/assets/v3.0/image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $employee['image'] = $image_url;

            @unlink($request->old_photo);

            $employee->save();
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Updated',
                'alert-type' => 'info'
            );
            return Redirect()->to('crud-v3')->with($notification);
        }
        else {
            $employee['image'] = $request->old_photo;

            $employee->save();
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Updated',
                'alert-type' => 'info'
            );
            return Redirect()->to('crud-v3')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Vthreeemployee::findorfail($id);

        $employee->delete();
        if($employee) {

            @unlink($employee->image);
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Deleted',
                'alert-type' => 'success'
            );
            return Redirect()->to('crud-v3')->with($notification);
        }
        else {
            $notification = array(
                'message' => 'Ops! something went wrong',
                'alert-type' => 'error'
            );
            return Redirect()->to('crud-v3')->with($notification);
        }
    }
}

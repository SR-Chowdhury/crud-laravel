<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CrudVersionOneController extends Controller
{
    public function dashboard() {
        $Bio = DB::table('v1bio')->get();
        // echo "<pre>";
        // print_r($Bio);
        return view('crudV1/home', compact('Bio'));

    }

    public function singleView($id) {
       $singleData = DB::table('v1bio')
       ->join('categories', 'v1bio.category_id', 'categories.id')
       ->select('v1bio.*', 'categories.name')
       ->where('v1bio.id', $id)
       ->first();
        return view('crudV1/singleView', compact('singleData'));
    }

    public function createForm() {
        $categories = DB::table('categories')->get();
        return view('crudV1/create', compact('categories'));
    }

    public function createMethod(Request $request) {

        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:v1bio',
            'phone' => 'required|unique:v1bio',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['category_id'] = $request->category_id;

        $image = $request->file('image');
        if($image) {
            $image_name = hexdec(uniqid());
            $extension = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$extension;
            $upload_path = 'public/assets/v1.0/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['image'] = $image_url;

            $storeBio = DB::table('v1bio')->insert($data);
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully inserted',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
        else {
            $storeBio = DB::table('v1bio')->insert($data);
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully inserted',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
}

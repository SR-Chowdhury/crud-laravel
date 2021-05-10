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
            'user_name' => 'required',
            'email' => 'required|unique:v1bio',
            'phone' => 'required|unique:v1bio',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // echo $request->user_name;

        $data = array();
        $data['user_name'] = $request->user_name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['category_id'] = $request->category_id;

        $image = $request->file('image');
        if($image) {
            $image_name = hexdec(uniqid());
            $extension = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$extension;
            $upload_path = 'public/assets/v1.0/image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['image'] = $image_url;

            $storeBio = DB::table('v1bio')->insert($data);
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully inserted',
                'alert-type' => 'success'
            );
            return Redirect()->route('dashboard-v1')->with($notification);
        }
        else {
            $storeBio = DB::table('v1bio')->insert($data);
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully inserted',
                'alert-type' => 'success'
            );
            return Redirect()->route('dashboard-v1')->with($notification);
        }
    }

    public function editMethod($id) {
        $categories = DB::table('categories')->get();
        $data = DB::table('v1bio')
                ->join('categories', 'v1bio.category_id', 'categories.id')
                ->select('v1bio.*', 'categories.name')
                ->where('v1bio.id', $id)
                ->first();
        return view('crudV1/edit', compact('categories', 'data'));
    }

    public function updateMethod(Request $request, $id) {

        $validation = $request->validate([
            'user_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = array();
        $data['user_name'] = $request->user_name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['category_id'] = $request->category_id;

        $image = $request->file('image');
        if($image) {
            $image_name = hexdec(uniqid());
            $extension = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$extension;
            $upload_path = 'public/assets/v1.0/image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['image'] = $image_url;

            @unlink($request->old_photo);

            $updateBio = DB::table('v1bio')->where('id', $id)->update($data);
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('dashboard-v1')->with($notification);
        }
        else {
            $data['image'] = $request->old_photo;
            $updateBio = DB::table('v1bio')->where('id', $id)->update($data);
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('dashboard-v1')->with($notification);
        }
    }

    public function deleteMethod($id) {
        $deleteData = DB::table('v1bio')->where('id', $id)->delete();
        if($deleteData) {
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Deleted',
                'alert-type' => 'success'
            );
            return Redirect()->route('dashboard-v1')->with($notification);
        }
        else {
            $notification = array(
                'message' => 'Ops! something went wrong',
                'alert-type' => 'error'
            );
            return Redirect()->route('dashboard-v1')->with($notification);
        }
    }
}

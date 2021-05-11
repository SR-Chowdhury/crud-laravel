<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Vtwostudent;

use DB;

class CrudVersionTwoController extends Controller
{
    // Home Method
    public function dashboard() {
        $student = Vtwostudent::all();
        return view('crudV2/home', compact('student'));
    }
    // Single View Method
    public function singleView($id) {
        // $singleData = Vtwostudent::findorfail($id);

        $singleData = DB::table('vtwostudents')
                    ->join('categories', 'vtwostudents.category_id', 'categories.id')
                    ->select('vtwostudents.*', 'categories.name')
                    ->where('vtwostudents.id', $id)
                    ->first();
        return view('crudV2/singleView', compact('singleData'));
    }
    // Create From Method
    public function createForm() {
        $categories = Categorie::all();
        return view('crudV2/create', compact('categories'));
    }
    // Store Method
    public function storeMethod(Request $request) {

        $validate = $request->validate([
            'user_name' => 'required',
            'email' => 'required|unique:vtwostudents',
            'phone' => 'required|unique:vtwostudents',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $student = new Vtwostudent;
        $student->user_name = $request->user_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->category_id = $request->category_id;
        // return response()->json($student);

        $image = $request->file('image');

        if($image) {
            $image_name = hexdec(uniqid());
            $extension = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$extension;
            $upload_path = 'public/assets/v2.0/image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $student->image = $image_url;

            $student->save();

            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully inserted',
                'alert-type' => 'success'
            );
            return Redirect()->route('home-v2')->with($notification);
        }
        else {
            $student->save();

            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully inserted',
                'alert-type' => 'success'
            );
            return Redirect()->route('home-v2')->with($notification);
        }
    }
    // Edit Method
    public function editMethod($id) {
        $categories = DB::table('categories')->get();
        $data = DB::table('vtwostudents')
                ->join('categories', 'vtwostudents.category_id', 'categories.id')
                ->select('vtwostudents.*', 'categories.name')
                ->where('vtwostudents.id', $id)
                ->first();
        return view('crudV2/edit', compact('categories', 'data'));
    }
    // Update Method
    public function updateMethod(Request $request, $id) {

        $validate = $request->validate([
            'user_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $student = Vtwostudent::findorfail($id);
        $student->user_name = $request->user_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->category_id = $request->category_id;

        $image = $request->file('image');
        if($image) {
            $image_name = hexdec(uniqid());
            $extension = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$extension;
            $upload_path = 'public/assets/v2.0/image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $student['image'] = $image_url;

            @unlink($request->old_photo);

            $student->save();
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('home-v2')->with($notification);
        }
        else {
            $student['image'] = $request->old_photo;

            $student->save();
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('home-v2')->with($notification);
        }
    }
    // Delete Method
    public function deleteMethod($id) {
        $student = Vtwostudent::findorfail($id);

        $student->delete();
        if($student) {

            @unlink($student->image);
            $notification = array(
                'message' => 'Alhamdulillah, Data is successfully Deleted',
                'alert-type' => 'success'
            );
            return Redirect()->route('home-v2')->with($notification);
        }
        else {
            $notification = array(
                'message' => 'Ops! something went wrong',
                'alert-type' => 'error'
            );
            return Redirect()->route('home-v2')->with($notification);
        }
    }
}

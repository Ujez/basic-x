<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function About(){
        $homeabout = HomeAbout::latest()->get();
        return view('admin.about.index', compact('homeabout'));
    }

    public function AddAbout(){
        return view('admin.about.create');
    }

    public function StoreAbout(Request $request){
        
        HomeAbout::insert([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success','About Inserted Successfully');
    }


    public function EditAbout($id){
        $homeabout = HomeAbout::find($id);
        return view('admin.about.edit',compact('homeabout'));
    }

    public function UpdateAbout(Request $request, $id){
        $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            
        ]);

        return Redirect()->route('home.about')->with('success','About Updated Successfully');
    }

    public function DeleteAbout($id){
        $delete = HomeAbout::find($id)->Delete();
        return Redirect()->back()->with('success','About Deleted Successfully');
    }

    public function Portfolio(){
        $images = Multipic::all();
        return view('pages.portfolio',compact('images'));
    }



}

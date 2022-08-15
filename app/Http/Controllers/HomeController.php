<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }
    public function AddSlider()
    {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {
        $validatedData = $request->validate(
            [

                'slider_image.required' => 'Opps, seems you forgot to input your image here',
            ]);

        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, null)->save('image/slider/' . $name_gen);

        $last_img = 'image/slider/' . $name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');

    }
    public function Edit($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.editslider', compact('sliders'));

    }
    public function Update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [

                'slider_image.required' => 'Opps, seems you forgot to input your image here',
            ]);

        $slider_image = $request->file('image');
        $old_image = $request->old_image;

        if ($slider_image) {

            $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920, null)->save('image/slider/' . $name_gen);
            $last_img = 'image/slider/' . $name_gen;

            unlink($old_image);
            Slider::find($id)->Update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);

            return Redirect()->back()->with('success', 'Slider Updated Successfully');
        } else {
            Slider::find($id)->Update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);

            return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully');
        }

    }
    public function delete($id)
    {
        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider Deleted');
    }

}

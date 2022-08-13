<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    Public function HomeSlider(){ 
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }
}

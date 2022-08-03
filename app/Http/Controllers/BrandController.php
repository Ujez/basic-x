<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function AllBrand()
    {

        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg.jpeg,png',
        ],
            //opotionally customize your error message
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => 'Brand longer than 4 Characters',
            ]);

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());

        $img_ext = strtolower($brand_image->getClientOriginalExtension());

        $img_name = $name_gen . '.' . $img_ext;

        $up_location = 'image/brand/';

        $last_img = $up_location . $img_name;

        $brand_image->move($up_location, $img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        // $category = new Category;
        // $category ->brand_name = $request->brand_name;
        // $category -> user_id = Auth::user()->id;
        // $category->save();

        //Using the Query builder pattern to insert data
        // $data = array();
        // $data['brand_name'] = $request->brand_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Brand Inserted Successfully');

    }
    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));

    }
}

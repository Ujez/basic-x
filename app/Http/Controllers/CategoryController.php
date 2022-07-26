<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function AllCat()
    {
        return view('admin.category.index');
    }
    public function AddCat(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
            //opotionally customize your error message
            [
                'category_name.required' => 'Please Input Category Name',
                'category_name.max' => 'Category less than the required 25 characters',
            ]);


        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now(),
        // ]);

        // $category = new Category;
        // $category ->category_name = $request->category_name;
        // $category -> user_id = Auth::user()->id;
        // $category->save();

        //Using the Query builder pattern to insert data
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Category Inserted Successfully');

    }
}

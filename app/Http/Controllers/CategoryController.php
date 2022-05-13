<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::get(); // this select all data from database
        $categories = Category::orderBy('id','DESC')->paginate(3);

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show',compact('category'));
    }

    // Category:create
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validate
        $request ->validate([
            'name' => 'required | string | max:100',
        ]);

        $name = $request->name ;
        Category::create([
            'name' => $name,
        ]);

        return redirect( route('categories.index') );
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit' , compact('category'));
    }


    public function update(Request $request , $id)
    {

        // Validate
        $request ->validate([
            'name' => 'required | string | max:100',
        ]);

        // To update the img from the Uplodes / categories folder
        $book = Category::findOrFail($id);

        $book->update([
            'name' => $request->name,
        ]);

        return redirect( route('categories.edit', $id));
    }

    public function delete($id)
    {
        // To remove the img from the Uplodes / categories folder
        $category = Category::findOrFail($id);

        // To remove any book
        $category ->delete();
        // return back();
        return redirect( route('categories.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ApiBookController extends Controller
{
    public function index()
    {
        // $books = Book::get();
        $books = Book::select('id', 'title')->get();
        return response()->json($books);
    }

    public function show($id)
    {

        $book = Book::with('categories')->findOrFail($id);

        return response()->json($book);
    }

    public function store(Request $request)
    {
        // Validate without no control
        // $request ->validate([
        //     'title' => 'required | string | max:100',
        //     'decs' => 'required | string',
        //     'img' => 'required | image | mimes:png,jpg',
        //     'category_ids' => 'required' ,
        //     'category_ids.*' => 'exists:categories,id'
        // ]);

        // Validate with full control
        $validator = Validator::make($request->all(), [
            'title' => 'required | string | max:100',
            'decs' => 'required | string',
            'img' => 'required | image | mimes:png,jpg',
            'category_ids' => 'required' ,
            'category_ids.*' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        // Move Image To Public Folder / Uplodes / Books
        $img = $request->file('img');
        $ext = $img->getClientOriginalExtension();
        $name = "book-" . uniqid() . ".$ext" ;
        $img ->move(public_path('Uplodes/books') , $name);

        $title = $request->title ;
        $decs = $request->decs ;

        $book = Book::create([
            'title' => $title,
            'decs' => $decs ,
            'img' => $name ,
        ]);

        $book->categories()->sync($request->category_ids);
        // To Redirect to another blade page
        $success = "book Created Successfully";
        return response()->json($success);
    }


    public function update(Request $request , $id)
    {

        // Validate without control
        // $request ->validate([
        //     'title' => 'required | string | max:100',
        //     'decs' => 'required | string',
        //     'img' => 'nullable|image|mimes:png,jpg'
        // ]);

        // Validate with full control
        $validator = Validator::make($request->all(), [
            'title' => 'required | string | max:100',
            'decs' => 'required | string',
            'img' => 'required | image | mimes:png,jpg',
            'category_ids' => 'required' ,
            'category_ids.*' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }


        // To update the img from the Uplodes / books folder
        $book = Book::findOrFail($id);
        $name = $book->img ;
        if($request->hasFile('img'))
        {
            if($name !== null)
            {
                unlink(public_path('Uplodes/books/') . $book->img);
            }
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $name = "book-" . uniqid() . ".$ext" ;
            $img ->move(public_path('Uplodes/books') , $name);
        }


        $book->update([
            'title' => $request->title,
            'decs' => $request->decs ,
            'img' => $name
        ]);

        $book->categories()->sync($request->category_ids);

        $success = "book updated Successfully";
        return response()->json($success);
    }

    public function delete($id)
    {
        // To remove the img from the Uplodes / books folder
        $book = Book::findOrFail($id);
        if( $book->img !== null)
        {
            unlink(public_path('Uplodes/books/') . $book->img);
        }

        $book->categories()->sync([]);

        $book ->delete();

        $success = "book deleted Successfully";
        return response()->json($success);
    }
}

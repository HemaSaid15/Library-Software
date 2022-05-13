<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;

class BookController extends Controller
{
    public function index()
    {
        // $books = Book::get(); // this select all data from database
        $books = Book::orderBy('id','DESC')->paginate(3);

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        // Book::where('id','=',$id)->first(); //this can be يختصر
        // $book = Book::find($id); // This will give me an error if the id not found to avoid this
        $book = Book::findOrFail($id); // This method return 404 insted of error

        return view('books.show',compact('book'));
    }

    // Book:create
    public function create()
    {
        $categories = Category::select('id' , 'name')->get();
        return view('books.create' , compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate
        $request ->validate([
            'title' => 'required | string | max:100',
            'decs' => 'required | string',
            'img' => 'required | image | mimes:png,jpg',
            'category_ids' => 'required' ,
            'category_ids.*' => 'exists:categories,id'
        ]);

        // Move Image To Public Folder / Uplodes / Books
        $img = $request->file('img');
        $ext = $img->getClientOriginalExtension();
        $name = "book-" . uniqid() . ".$ext" ;
        $img ->move(public_path('Uplodes/books') , $name);


        // dd( $request->title ); //This return only the input feild that has name title
        // dd ( $request->decs );
        // dd( $request->all()); // all function return all the data that user enter in form and csrf

        $title = $request->title ;
        $decs = $request->decs ;

        // To Store the data you get in your dataBase
        // create method take an assosiative array which has key and value
        $book = Book::create([
            'title' => $title,
            'decs' => $decs ,
            'img' => $name ,
        ]);

        $book->categories()->sync($request->category_ids);
        // To Redirect to another blade page

        return redirect( route('books.index') );
    }

    public function edit($id)
    {
        // $book = Book::select('title', 'decs')->where('id','=',$id)->get();
        $book = Book::findOrFail($id);
        return view('books.edit' , compact('book'));
    }


    public function update(Request $request , $id)
    {

        // Validate
        $request ->validate([
            'title' => 'required | string | max:100',
            'decs' => 'required | string',
            'img' => 'nullable|image|mimes:png,jpg'
        ]);

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

        return redirect( route('books.edit', $id));
    }

    public function delete($id)
    {
        // To remove the img from the Uplodes / books folder
        $book = Book::findOrFail($id);
        if( $book->img !== null)
        {
            unlink(public_path('Uplodes/books/') . $book->img);
        }

        // To remove any book
        $book ->delete();
        // return back();
        return redirect( route('books.index'));
    }
}



// $books = Book::select('title','decs')->get();  // Select a specific columns
// $books = Book::where('id','>=',2)->get();
// $books = Book::select('title','decs')->where('id','>=',2)->get();
// $books = Book::select('title','decs')->where('id','>=',2)->orderBy('id','DESC')->get();
// dd($books); // die and dumb and do echo and stop the code after it

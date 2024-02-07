<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){

        $books = Book::paginate(10) ;

        return view('books.index') 
        ->with('books', $books) ;
    }
    public function show($booksId){
        $book = Book::find($booksId) ;
        return view('books.show')
        ->with('book', $book) ;
    }
    public function create(){
        return view('books.create') ;
    }
    public function store(Request $request){
        $rules = [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'price' => 'required|numeric',
            'isbn' => 'required|digits:13',
            'stock' => 'required|numeric|min:0'
        ] ;
     $data = $request->validate($rules) ;
        $book = new Book() ;
        $book->forceFill($data);
        // $book->title = $request->title ;
        // $book->author = $request->author ;
        // $book->price = $request->price ;
        // $book->isbn = $request->isbn ;
        // $book->stock = $request->stock ;
        $book->save() ;
        return redirect()->route('books.show', $book->id);

    }
    public function edit($booksId){
        $book = Book::find($booksId) ;
        return view('books.edit')
        ->with('book', $book) ;
    }
    public function update(Request $request){
        $rules = [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'price' => 'required|numeric',
            'isbn' => 'required|digits:13',
            'stock' => 'required|numeric|min:0'
        ] ;
        $request->validate($rules) ;
        $book = Book::find($request->id) ;
        $book->title = $request->title ;
        $book->author = $request->author ;
        $book->price = $request->price ;
        $book->isbn = $request->isbn ;
        $book->stock = $request->stock ;
        $book->save() ;
        return redirect()->route('books.show', $book->id);

    }
    public function destroy(Request $request){
        $book= Book::find($request->id) ;
        $book->delete() ;
        return redirect()->route('books.index') ;
    }
}

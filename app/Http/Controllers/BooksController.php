<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function index()
    {
        $books = Book::with('genre')->paginate(10);
        return view('user.index', compact('books'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('title', 'like', "%{$query}%")
            ->orWhere('author_name', 'like', "%{$query}%")
            ->paginate(8);

        return view('user.books.search', compact('books'));
    }

    public function details($id)
    {
        $book = Book::findOrFail($id);
        return view('user.books.details', compact('book'));

    }
    
}

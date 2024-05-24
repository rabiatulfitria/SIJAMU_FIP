<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = session()->get('books', []);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.form');
    }

    public function store(Request $request)
    {
        $books = session()->get('books', []);
        $books[] = $request->only(['title', 'author', 'year']);
        session()->put('books', $books);

        return redirect()->route('books.index');
    }

    public function edit($id)
    {
        $books = session()->get('books', []);
        if (!isset($books[$id])) {
            return redirect()->route('books.index');
        }

        $book = $books[$id];
        return view('books.form', compact('book', 'id'));
    }

    public function update(Request $request, $id)
    {
        $books = session()->get('books', []);
        if (!isset($books[$id])) {
            return redirect()->route('books.index');
        }

        $books[$id] = $request->only(['title', 'author', 'year']);
        session()->put('books', $books);

        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        $books = session()->get('books', []);
        if (isset($books[$id])) {
            unset($books[$id]);
            session()->put('books', array_values($books));
        }

        return redirect()->route('books.index');
    }
}

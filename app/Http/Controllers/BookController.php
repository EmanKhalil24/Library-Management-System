<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Models\book;
class BookController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publication_year' => 'required|integer',
            'ISBN' => 'required|integer',
        ]);
    
        try {
            $item = new book();
            $item->title = $validatedData['title'];
            $item->author = $validatedData['author'];
            $item->publication_year = $validatedData['publication_year'];
            $item->ISBN = $validatedData['ISBN'];    
            $item->save();
    
            return response()->json([
                'Message' => 'Book added successfully',
                'Book' => $item,
            ], 201);
        } catch (QueryException $exception) {
            logger()->error('Failed to add book: ' . $exception->getMessage());
            return response()->json(['message' => 'Failed to add book. Error: ' . $exception->getMessage()], 500);
        }
    }    

    public function showBooks()
    {
        $books = Book::all();
        if ($books->isEmpty()) {
            return response()->json(['message' => 'No books found'], 404);
        }
        return response()->json(['Books' => $books], 200);
    }

    public function showBookDetails($book_id)
    {
        $book = book::find($book_id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json(['Book details' => $book]);
    }

    public function updateBook(Request $request, $book_id)
    {
        $book = book::findOrFail($book_id);

        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->publication_year = $request['publication_year'];
        $book->ISBN = $request['ISBN'];    
        $book->save();

        return response()->json(['message' => 'Book updated successfully', 'post' => $book]);
    }

    public function deleteBook($book_id)
    {
        $book = book::find($book_id);

        if (!$book) {
            return response()->json(['message' => 'Book not found!'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully!'], 200);
    }
}

// public function check(){
//     return "Checking";
// }

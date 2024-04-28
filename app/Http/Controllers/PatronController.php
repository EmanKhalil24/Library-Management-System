<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\patron;
use App\Models\book;
use App\Models\borrowing_record;

class PatronController extends Controller
{
    public function addPatron(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'contact_info' => 'required|string',
        ]);
    
        try {
            $parton = new patron();
            $parton->name = $validatedData['name'];
            $parton->contact_info = $validatedData['contact_info']; 
            $parton->save();
    
            return response()->json([
                'Message' => 'Patron added successfully!',
                'Patron' => $parton,
            ], 201);
        } catch (QueryException $exception) {
            logger()->error('Failed to add patron: ' . $exception->getMessage());
            return response()->json(['message' => 'Failed to add patron. Error: ' . $exception->getMessage()], 500);
        }
    }    

    public function showPatronDetails($patron_id)
    {
        $patron = patron::find($patron_id);

        if (!$patron) {
            return response()->json(['message' => 'Patron not found'], 404);
        }
        return response()->json(['Patron details' => $patron]);
    }

    public function showPatrons()
    {
        $patrons = patron::all();
        if ($patrons->isEmpty()) {
            return response()->json(['message' => 'No patrons found!'], 404);
        }
        return response()->json(['Patrons' => $patrons], 200);
    }

    public function updatePatron(Request $request, $patron_id)
    {
        $patron = patron::findOrFail($patron_id);

        $patron->name = $request['name'];
        $patron->contact_info = $request['contact_info'];  
        $patron->save();

        return response()->json(['message' => 'Patron updated successfully!', 'Patron' => $patron]);
    }

    public function deletePatron($patron_id)
    {
        $patron = patron::find($patron_id);

        if (!$patron) {
            return response()->json(['message' => 'Patron not found!'], 404);
        }

        $patron->delete();

        return response()->json(['message' => 'Patron deleted successfully!'], 200);
    }

    public function borrowBook(Request $request, $book_id, $patron_id)
    {
        $book = Book::find($book_id);
        $patron = Patron::find($patron_id);
    
        if (!$book || !$patron) {
            return response()->json(['message' => 'Book or patron not found!'], 404);
        }
    
        if ($book->is_borrowed) {
            return response()->json(['message' => 'Book is already borrowed!'], 400);
        }
    
        $borrowingRecord = new borrowing_record([
            'borrowing_date' => now(),
            'bookId' => $book_id,
        ]);
    
        $borrowingRecord->save();
        $book->is_borrowed = true;
        $book->save();
        $patron->borrowingRecords()->save($borrowingRecord);
        return response()->json(['message' => 'Book borrowed successfully!'], 200);
    }

    public function returnBook(Request $request, $book_id)
    {
        $book = book::find($book_id);
        if (!$book) {
            return response()->json(['message' => 'Book not found!'], 404);
        }
    
        $borrowingRecord = borrowing_record::where('bookId', $book_id)
            ->whereNull('return_date')
            ->first();
    
        if ($borrowingRecord) {
            $borrowingRecord->return_date = now();
            $borrowingRecord->save();
    
            return response()->json(['message' => 'Book returned successfully!'], 200);
        } else {
            return response()->json(['message' => 'No active borrowing record found!'], 404);
        }
    }
}
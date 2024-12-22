<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $limit = request()->input('limit', 10);
            // $books = Book::limit($limit)->get();
            $books = Book::limit($limit)->get();
            return response()->json([
                "status" => "Get Data book",
                "data" => $books
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to retrieve data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $book = Book::create($request->validated());

            return response()->json([
                "status" => "Book created successfully",
                "data" => $book
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to create book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        try {
            return response()->json([
                "status" => "Get Data Book",
                "data" => $book
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to retrieve data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            $book->update($request->validated());

            return response()->json([
                "status" => "Book updated successfully",
                "data" => $book
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to update book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();

            return response()->json([
                "status" => "Book deleted successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to delete book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

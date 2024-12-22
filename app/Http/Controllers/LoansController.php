<?php

namespace App\Http\Controllers;

use App\Models\Loans as Loan;
use App\Models\Book;
use App\Http\Requests\StoreLoansRequest as StoreLoanRequest;
use App\Http\Requests\UpdateLoansRequest as UpdateLoanRequest;
use Illuminate\Support\Carbon;

class LoansController extends Controller
{
    public function index()
    {
        try {
            $loans = Loan::with('user', 'book')->paginate(10);

            return response()->json([
                'status' => 'Get Data Loans',
                'data' => $loans
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to retrieve data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created loan in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        try {
            $loan = Loan::create($request->validated());

            return response()->json([
                'status' => 'Loan created successfully',
                'data' => $loan
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to create loan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified loan.
     */
    public function show(Loan $loan)
    {
        try {
            return response()->json([
                'status' => 'Get Data Loan',
                'data' => $loan->load('user', 'book')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to retrieve data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified loan in storage.
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        try {
            $loan->update($request->validated());

            return response()->json([
                'status' => 'Loan updated successfully',
                'data' => $loan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to update loan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified loan from storage.
     */
    public function destroy(Loan $loan)
    {
        try {
            $loan->delete();

            return response()->json([
                'status' => 'Loan deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed to delete loan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

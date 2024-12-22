<?php

namespace Database\Factories;

use App\Models\Loans as Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loans>
 */
class LoansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loanDate = Carbon::parse($this->faker->dateTimeBetween('-1 month', 'now'));
        $dueDate = $loanDate->copy()->addDays(14);
        $returnDate = $this->faker->boolean(70) ? $loanDate->copy()->addDays(rand(1, 20)) : null; // 70% kemungkinan ada tanggal pengembalian
        $fine = $returnDate && $returnDate->greaterThan($dueDate)
            ? ($returnDate->diffInDays($dueDate) * 5000) // Misal, denda Rp5.000 per hari
            : null;

        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'return_date' => $returnDate,
            'fine' => $fine,
        ];
    }
}

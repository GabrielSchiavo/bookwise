<?php
namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\BookLoan;
use Closure;
use Carbon\Carbon;

class UpdateBookStatus
{
    public function handle($request, Closure $next)
    {
        $dateNow = Carbon::now()->toDateString();
        BookLoan::where(function ($query) use ($dateNow) {
            $query->where('return_date', '<', $dateNow);
        })->update([
            'status' => 'ATRASADO',
        ]);

        $getIdLateBooks = BookLoan::where(function ($query) use ($dateNow) {
            $query->where('return_date', '<', $dateNow);
        })->value('book_id');
        Book::where('id', '=', $getIdLateBooks)->update([
            'status' => 'ATRASADO',
        ]);
        
        return $next($request);
    }
}

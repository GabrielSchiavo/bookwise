<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookLoan extends Model
{
    use HasFactory;

    protected $table = 'books_loans';
    protected $primaryKey = 'id';

    protected $fillable = ['loan_date', 'return_date', 'person', 'book_id', 'book', 'status'];

    public function bookId(): BelongsTo {
        return $this->belongsTo(Book::class);
    }
}

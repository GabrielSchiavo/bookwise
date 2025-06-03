<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'id';

    protected $fillable = ['cover_image', 'title', 'series', 'volume', 'author', 'literary_gender_id', 'literary_gender', 'publisher', 'year', 'isbn', 'status'];

    public function literaryGenderId(): BelongsTo {
        return $this->belongsTo(LiteraryGenre::class);
    }

    public function bookLoanId(): HasOne {
        return $this->hasOne(BookLoan::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiteraryGenre extends Model
{
    use HasFactory;

    protected $table = 'literary_genres';
    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function booksIds(): HasMany {
        return $this->hasMany(Book::class);
    }
}

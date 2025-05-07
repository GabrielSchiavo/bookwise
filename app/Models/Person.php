<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $primaryKey = 'id';

    protected $fillable = ['name_last_name', 'phone', 'email'];

    public function bookLoanId(): HasMany {
        return $this->hasMany(BookLoan::class);
    }
}

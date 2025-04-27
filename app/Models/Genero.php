<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genero extends Model
{
    use HasFactory;

    protected $table = 'generos';
    protected $primaryKey = 'id';

    protected $fillable = ['nome'];

    public function livros_id(): HasMany {
        return $this->hasMany(Livros::class);
    }
}

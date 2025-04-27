<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Livros extends Model
{
    use HasFactory;

    protected $table = 'livros';
    protected $primaryKey = 'id';

    protected $fillable = ['genero', 'genero_id', 'isbn', 'titulo', 'autor', 'editora', 'ano', 'imgCapa', 'status'];

    public function genero(): BelongsTo {
        return $this->belongsTo(Genero::class);
    }

    public function reserva_id(): HasOne {
        return $this->hasOne(Retirada::class);
    }
}

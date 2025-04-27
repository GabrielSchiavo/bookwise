<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Retirada extends Model
{
    use HasFactory;

    protected $table = 'retiradas';
    protected $primaryKey = 'id';

    protected $fillable = ['dataRetirada', 'dataDevolucao', 'pessoa', 'livro', 'status', 'livro_id'];

    public function livros_id(): BelongsTo {
        return $this->belongsTo(Livros::class);
    }
}

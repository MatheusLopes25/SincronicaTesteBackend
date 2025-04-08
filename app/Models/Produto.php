<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\BaseModel;

class Produto extends BaseModel
{
    use HasFactory;

    protected $fillable = ['nome', 'preco', 'descricao', 'categoria_id'];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}

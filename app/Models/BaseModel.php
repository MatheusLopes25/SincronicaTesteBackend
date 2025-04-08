<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class BaseModel extends Model
{
  

    /**
    *  Função utlizada para formatar  a hora e o tempo das colunas Created_at e update_at.
    */
    public function serializeDate(\DateTimeInterface $date) 
    {
        return Carbon::parse($date)->format('d/m/Y H:i');
    }

}

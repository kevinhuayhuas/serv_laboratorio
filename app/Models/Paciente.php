<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function tipoDocIdentidad()
    {
        return $this->belongsTo(TipoDocIdentidad::class, 'tipo_doc_identidad_id');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    //Atributo adicionado para setar o formato de retorno da coluna
    protected $casts = [
        'date' => 'datetime:d/m/Y'
    ];

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strtoupper($value) 
        );
    }

    protected function titleAndBody(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => "{$attributes['title']} - {$attributes['body']}"
        );
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Carbon::make($value)->format('Y-m-d')
        );
    }
}

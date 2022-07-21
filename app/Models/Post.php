<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

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
}

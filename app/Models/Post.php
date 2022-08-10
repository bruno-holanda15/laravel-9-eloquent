<?php

namespace App\Models;

use App\Models\Scopes\YearScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    protected static function booted()
    {
        // static::addGlobalScope('year', function (Builder $query) {
        //     $query->whereYear('date', Carbon::now()->year);
        // });
        static::addGlobalScope(new YearScope);
    }

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

    public function scopeToday()
    {
        return $this->where('date', Carbon::now()->format('Y-m-d'))->get();
    }
}

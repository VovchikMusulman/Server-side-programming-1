<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'title',
        'author',
        'year',
        'description',
        'category_id'
    ];

    // Отношение с категорией (если есть модель Category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Мутатор для заголовка
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }

    // Аксессор для года издания
    public function getYearAttribute($value)
    {
        return $value ? $value . ' г.' : null;
    }
}
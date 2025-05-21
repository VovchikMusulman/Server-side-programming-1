<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Model\Reader;

class Book extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'title',
        'author',
        'year',
        'description',
        'category_id',
        'reader_id',    // ID читателя, которому выдана книга
        'issue_date',   // Дата выдачи
        'return_date'  // Дата возврата
    ];

    // Отношение с категорией (если есть модель Category)
    public function category()
    {
        return $this->belongsTo(Reader::class);
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
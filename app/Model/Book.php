<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Model\User;

class Book extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'title',
        'author',
        'year',
        'price',
        'is_new',
        'description',
        'popular_book',
        'reader_id',    // ID читателя, которому выдана книга
        'image'         // Добавляем поле для изображения
    ];

    // Исправленное отношение с читателем
    public function reader()
    {
        return $this->belongsTo(User::class, 'reader_id');
    }
}
<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;
use Model\Book;

class Reader extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'phone',
        'address',
        'email',
        'birth_date',
        'library_card', // Номер читательского билета
    ];

    public function book()
    {
        return $this->hasMany(Book::class);
    }

    public $timestamps = false;
}
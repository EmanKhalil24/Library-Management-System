<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
    protected $primaryKey = 'book_id';
    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'ISBN',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowing_record extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'borrowing_date',
        'return_date',
        'bookId',
    ];
}

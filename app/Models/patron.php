<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\borrowing_record;


class patron extends Model
{
    use HasFactory;
    protected $primaryKey = 'patron_id';
    protected $fillable = [
        'name',
        'contact_info',
    ];

    public function borrowingRecords()
    {
        return $this->hasMany(borrowing_record::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "books";

    protected $fillable = [
        'isbn', 'name', 'value'
    ];

    protected $dates = ['deleted_at'];

    public $temp_deleted_at;

    public function userBook()
    {
        return $this->hasOne(UserBook::class);
    }
}

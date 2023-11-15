<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    use HasFactory;
    protected $table="book";

    public function chapter_data()
    {
        return $this->hasMany(ChapterModel::class,'book_id');
    }
}

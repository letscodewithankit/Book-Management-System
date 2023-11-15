<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterModel extends Model
{
    use HasFactory;
    protected $table="chapters";
    public function heading_data()
    {
        return $this->hasMany(HeadingModel::class,'chapter_id');
    }
}

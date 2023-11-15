<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RulesModel extends Model
{
    use HasFactory;

    protected $table="rules";

    public function chapter_name()
    {
        return $this->belongsTo(ChapterModel::class,'chapter_id');
    }
    public function heading_name()
    {
        return $this->belongsTo(HeadingModel::class,'heading_id');
    }
    public function subheading_name()
    {
        return $this->belongsTo(SubHeadingModel::class,'subheading_id');
    }
    public function subsubheading_name()
    {
        return $this->belongsTo(SubSubHeadingModel::class,'subsubheading_id');
    }

}

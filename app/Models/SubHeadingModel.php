<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubHeadingModel extends Model
{
    use HasFactory;
    protected $table="subheading";
    public function SubSubheading_data()
    {
        return $this->hasMany(SubSubHeadingModel::class,'subheading_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadingModel extends Model
{
    use HasFactory;
    protected $table="heading";
    public function subheading_data()
    {
        return $this->hasMany(SubHeadingModel::class,'heading_id');
    }
}

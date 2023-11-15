<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubHeadingModel extends Model
{
    use HasFactory;
    protected $table="subsubheading";
    public function description()
    {
        return $this->hasMany(RulesModel::class,'subsubheading_id');
    }
}

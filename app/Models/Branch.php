<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    //use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [];


    ########## Relations ##########

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function charitablefoundation()
    {
        return $this->belongsTo(Charitablefoundation::class);
    }



}

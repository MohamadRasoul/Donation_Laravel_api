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

    public function donationPosts()
    {
        return $this->hasMany(DonationPost::class);
    }

    public function cases()
    {
        return $this->hasMany(DonationPost::class)->where('post_type_id', 1);
    }

    public function sponsorShips()
    {
        return $this->hasMany(DonationPost::class)->where('post_type_id', 2);
    }

    public function campigns()
    {
        return $this->hasMany(DonationPost::class)->where('post_type_id', 3);
    }

    public function charitablefoundation()
    {
        return $this->belongsTo(Charitablefoundation::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use \Znck\Eloquent\Traits\BelongsToThrough;

class DonationPost extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia, BelongsToThrough;

    protected $guarded = [];

    protected $casts = [];


    ########## Relations ##########
    public function statusTypes()
    {
        return $this->belongsToMany(StatusType::class, 'donation_statuses');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'donations');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function charitablefoundation()
    {
        return $this->BelongsToThrough(Charitablefoundation::class, Branch::class);
    }

    public function state()
    {
        return $this->hasOne(State::class);
    }

    public function sponsorShips()
    {
        return $this->hasMany(SponsorShip::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }


    ########## Libraries ##########


    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('DonationPost')
            ->useFallbackUrl(env('APP_URL') . '/images/default.jpg')
            ->singleFile();
    }
}

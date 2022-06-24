<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DonationPost extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [];


    ########## Relations ##########
    public function statusTypes()
    {
        return $this->belongsToMany(StatusType::class, 'donation_statuses');
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

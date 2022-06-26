<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [];


    ########## Relations ##########

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function donationPost()
    {
        return $this->belongsTo(DonationPost::class);
    }

    public function supportProgram()
    {
        return $this->belongsTo(SupportProgram::class);
    }

    ########## Libraries ##########


    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('News')
            ->useFallbackUrl(env('APP_URL') . '/images/default.jpg')
            ->singleFile();
    }

}

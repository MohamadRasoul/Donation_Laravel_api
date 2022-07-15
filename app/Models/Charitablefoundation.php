<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Charitablefoundation extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [];


    ########## Relations ##########

    public function branchs()
    {
        return $this->hasMany(Branch::class);
    }

    public function donationPosts()
    {
        return $this->hasManyThrough(DonationPost::class, Branch::class);
    }

    public function supportPrograms()
    {
        return $this->hasManyThrough(SupportProgram::class, Branch::class);
    }

    public function news()
    {
        return $this->hasManyThrough(News::class, Branch::class);
    }


    ########## Libraries ##########


    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('Charitablefoundation')
            ->useFallbackUrl(env('APP_URL') . '/images/default.jpg')
            ->singleFile();
        $this
            ->addMediaCollection('Charitablefoundation_cover')
            ->useFallbackUrl(env('APP_URL') . '/images/default.jpg')
            ->singleFile();
    }
}

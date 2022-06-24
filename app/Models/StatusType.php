<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class StatusType extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [];


    ########## Relations ##########



    ########## Libraries ##########


    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('StatusType')
            ->useFallbackUrl(env('APP_URL') . '/images/default.jpg')
            ->singleFile();
    }

}

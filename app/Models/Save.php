<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;

class Save extends Model
{
    use HasFactory;
    //use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [];


    ########## Relations ##########



    ########## Libraries ##########


    // public function registerMediaCollections(): void
    // {
    //     $this
    //         ->addMediaCollection('Save')
    //         ->useFallbackUrl(env('APP_URL') . '/images/default.jpg')
    //         ->singleFile();
    // }

}

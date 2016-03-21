<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = "flyer_photos";

    protected $guarded = [];

    protected $baseDir = 'flyers/photos';
    /**
     * A flyer is composed of many photos
     * @return photos
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public static function fromForm(UploadedFile $file)
    {
        $photo = new static;

        $name = time().$file->getClientOriginalName();

        $photo->path = $photo->baseDir.'/'.$name;

        $file->move($photo->baseDir, $name);


        return $photo;
    }
}
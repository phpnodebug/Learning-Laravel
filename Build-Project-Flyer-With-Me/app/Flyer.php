<?php

namespace App;

use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    protected $guarded = [];

    /**
     * A flyer is composed of many photos
     * @return photos
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    /**
     * scope query to those located at a given address
     *
     * @param  Builder $query
     * @param  string $zip
     * @param  string $street
     * @return Builder
     */
    public static function locatedAt($zip, $street)
    {
        $street = str_replace('-', ' ', $street);

        return static::where(compact('zip','street'))->firstOrFail();
    }

    public function getPriceAttribute($price)
    {
        return '$'.number_format($price);
    }

    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }

    public function owner()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }
}

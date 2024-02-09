<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Gallery;
use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    // relasi satu saja hanya yang tidak memiliki fk
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
    public function images()
    {
        if ($this->galleries) {
            return asset('storage/' . $this->galleries->path);
        }
    }
    // public function comments()
    // {
    //     return $this->hasManyThrough(Comment_Log::class, Gallery::class);
    // }
    public function avatar()
    {
        if ($this->profile) {
            if ($this->profile->photo) {

                return asset('storage/' . $this->profile->photo);
            }
        };
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$this->username}}";
    }
    public function likes()
    {
        return $this->belongsToMany(Gallery::class, 'gallery_like')->withTimestamps();
    }
    public function likesImage(Gallery $image)

    {
        // dd($this->likes());
        return $this->likes()->where('gallery_id', $image->id)->exists();
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

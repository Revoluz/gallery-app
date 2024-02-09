<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    protected $table = 'galleries';

    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment_Log::class);
    }
    public function images()
    {
        if ($this->path) {
            return asset('storage/' . $this->path);
        }
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'gallery_like')->withTimestamps();
    }
}

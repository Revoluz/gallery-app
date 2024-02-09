<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_Log extends Model
{
    protected $table = 'comment_logs';
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['gallery', 'user'];
    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

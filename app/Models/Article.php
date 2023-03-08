<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Fake;
use App\Models\Truth;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'source',
        'category',
        'image_file',
        'comments_open',
        'day_time',
        'view_number',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Fake::class);
    }

    public function truths()
    {
        return $this->hasMany(Truth::class);
    }

    public function fakes()
    {
        return $this->hasMany(Fake::class);
    }
}

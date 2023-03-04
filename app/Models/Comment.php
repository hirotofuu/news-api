<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\User;
use App\Models\Good;
use App\Models\Comment;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'day_time',
        'user_id',
        'article_id',
        'parent_id',
        'child_number'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    public function goods()
    {
        return $this->hasMany(Good::class);
    }




}

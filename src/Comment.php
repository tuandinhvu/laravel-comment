<?php

namespace Fastup\Comment;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'comments';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

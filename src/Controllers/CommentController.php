<?php

namespace Fastup\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Services\ProvinceService;
use Carbon\Carbon;
use Fastup\Comment\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(){
        $content    =   strip_tags(request('content'));
        $content    =   tag_filter($content, 'realestate');
        $comment    =   new Comment();
        $comment->content   =   $content;
        $comment->user_id   =   auth()->user()->id;
        $comment->source_id =   request('source_id');
        $comment->type  =   request('type_id');
        $comment->url   =   request('url','');
        $comment->created_at    =   Carbon::now();
        $comment->save();
        session()->forget('comment.id');
        session()->forget('comment.type');
        return redirect()->back();
    }
}

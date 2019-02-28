<?php

namespace Fastup\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Menu;
use App\RealEstate;
use App\Services\ProvinceService;
use Carbon\Carbon;
use Fastup\Comment\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function create(){
        $content    =   strip_tags(request('content'));
        $content    =   tag_filter($content, 'realestate');
        $comment    =   new Comment();
        $comment->content   =   $content;
        $comment->user_id   =   auth()->user()->id;
        $comment->source_id =   request('source_id');
        $comment->type  =   request('type');
        $comment->url   =   request('url','');
        $comment->created_at    =   Carbon::now();
        $comment->save();
        if(function_exists('notify')){
            Log::info('zzzzz');
            switch ($comment->type){
                case 'realestate':
                    $user_id    =   ($realestate = RealEstate::find($comment->source_id))?RealEstate::find($comment->source_id)->posted_by:auth()->user()->id;
                    Log::info($user_id .'-'. auth()->user()->id);
                    if($user_id != auth()->user()->id)
                        notify([$user_id], 'Bình luận mới', (auth()->user()->userinfo?auth()->user()->userinfo->full_name:auth()->user()->name).' vừa bình luận về bài viết của bạn.', route('detail-real-estate', ['slug'=>$realestate->slug.'-'.$realestate->id]));
                    break;
                case 'user':
                    $user_id    =   $comment->source_id;
            }
        }
        session()->forget('comment.id');
        session()->forget('comment.type');
        return redirect()->back();
    }
}

<?php
if (!empty($url)) {
    $comments = \Fastup\Comment\Comment::where('url', $url)->orderBy('created_at', 'DESC')->get();
} elseif (!empty($type) && !empty($id)) {
    $comments = \Fastup\Comment\Comment::where('type', $type)->where('source_id', $id)->orderBy('created_at', 'DESC')->get();
} else{
    $return = 1; ;
}
?>
@if(empty($return))
<div class="twt-wrapper">
    <div class="panel panel-info">
        <div class="panel-heading">
            Phản hồi từ thành viên
        </div>
        <div class="panel-body">
            @if(auth()->check())
            <form method="post" action="{{route('sendComment', ['source_id'=>$id, 'type'=>$type])}}">
                {{csrf_field()}}
                <textarea class="form-control" name="content" placeholder="Viết bình luận..." rows="3"></textarea>
                <br>
                <button href="#" class="btn btn-primary btn-sm pull-right">Gửi bình luận</button>
            </form>
            @else
                <textarea class="form-control" disabled="" placeholder="Vui lòng đăng nhập để gửi bình luận" rows="3"></textarea>
            @endif
            <div class="clearfix"></div>
            <hr>
            <ul class="media-list">

                @foreach($comments as $comment)
                    <li class="media">
                        <a href="#" class="pull-left">
                            <img src="{{$comment->user()->first()->avatar()}}" class="img-responsive" />
                        </a>
                        <div class="media-body">
                                    <span class="text-muted pull-right">
                                        <small class="text-muted">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans(\Carbon\Carbon::now())}}</small>
                                    </span>
                            <strong class="text-success">{{$comment->user()->first()->userinfo?$comment->user()->first()->userinfo->full_name:$comment->user()->first()->name}}</strong>
                            <p>
                                {!! $comment->content !!}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
    <style type="text/css">
        .twt-wrapper {
            margin-top: 10px;
        }
        .twt-wrapper .panel-body {
            max-height:650px;
            overflow:auto;
        }
        .twt-wrapper .media-list .media img {
            width:64px;
            height:64px;
            border:2px solid #e5e7e8;
        }
        .twt-wrapper .media-list .media {
            border-bottom:1px dashed #efefef;
            margin-bottom:25px;
        }
    </style>
@endif

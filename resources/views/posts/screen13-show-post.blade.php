@extends('layout')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if(isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    $user = Session::get('sUser');
    ?>
    {{--    Show posted user--}}
    <div class="post-sw-body">
        <div class = "author">
            {{--        avatar--}}
            <img class="avatar" src="{{url('frontend/images/avatars/' . $post->avatar)}}" alt="avatar">
            <div class = "post_info">
                <a href="{{url('user/' . $post->user_id . '/info')}}">{{$post->name}}</a> <br>
                <span class="text-muted" id="noti-time">{{$post->created_at}}</span>
            </div>
        </div>
        <br>
        <section id="showPost">
            <div id="showPostTitle"><b>{{$post->title}}</b></div>
            <div id="showPostContent">{!! $post->content !!}</div>
        </section>
        <hr>
    </div>
@endsection

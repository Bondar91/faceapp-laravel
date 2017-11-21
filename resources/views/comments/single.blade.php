@if (!$loop->first)
    <hr style="margin: 10px 0;">
@endif

<div id="comment_{{ $comment->id }}">
    @if (Auth::check() && $post->user_id === Auth::id())

        @include('comments.include.dropdown-menu')

    @endif
    <img src="{{ url('images/user-avatar/' . $comment->user->id . '/20') }}" alt="Avatar" class="img-responsive pull-left">
    <div style="padding-left: 5px; overflow: hidden;">
        <a href="">{{ $comment->user->name }}</a><br>
        {{ $comment->content }}
    </div>
</div>




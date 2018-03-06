@if (!$loop->first)
    <hr style="margin: 10px 0;">
@endif

<div id="comment_{{ $comment->id }}" class="{{ $comment->trashed() ? 'trashed' : '' }}">

    @if (belongs_to_auth($comment->user_id) || is_admin())

        @include('comments.include.dropdown-menu')

    @endif
    <img src="{{ url('images/user-avatar/' . $comment->user->id . '/20') }}" alt="Avatar" class="img-responsive pull-left">
    <div style="padding-left: 5px; overflow: hidden;">
        <a href="">{{ $comment->user->name }}</a><br>
        {{ $comment->content }}
    </div>
</div>




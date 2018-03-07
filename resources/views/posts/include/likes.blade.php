<form action="{{ url('/likes') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Polub <span class="label label-info">{{$post->likes->count()}}</span></button>
</form>
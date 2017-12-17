<div class="row">
    <div class="col-md-12">

        <form method="POST" action="{{ url('/comments') }}">
            <div class="pull-left">
                <img src="{{ url('images/user-avatar/' . Auth::id() . '/35') }}" alt="" class="img-responsive">
            </div>

            <div class="col-md-11">
                <div class="form-group{{ $errors->has('post_' .$post->id. '_comment_content') ? ' has-error' : '' }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="post_{{ $post->id }}_comment_content" class="form-control" cols="5" rows="2" placeholder="Skomentuj post!">{{ old('post_' .$post->id. '_comment_content') }}</textarea>

                    <button type="submit" class="btn btn-default pull-right" style="margin-top: 10px;">Dodaj komentarz!</button>

                    @if ($errors->has('post_' .$post->id. '_comment_content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('post_' .$post->id. '_comment_content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </form>

    </div>
</div>
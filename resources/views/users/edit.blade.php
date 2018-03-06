@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if(session()->has('alert-success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session()->get('alert-success') }}
                    </div>
                @endif
                <div class="panel panel-default">

                    <div class="panel-heading">Użytkownik {{ $user->id }}</div>

                    <div class="panel-body ">

                        <img src="{{ url('images/user-avatar/' . $user->id . '/300') }}" alt="Avatar image" class="thumbnail img-responsive" style="margin:auto;">


                        <form action="{{ url('/users/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                        <label for="name">Avatar</label>
                                        <input type="file" name="avatar" class="form-control">

                                        @if ($errors->has('avatar'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name">Imie i nazwisko</label>
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="sex">Płeć</label>
                                        <select name="sex" id="sex" class="form-control">
                                            <option value="f" @if ($user->sex == 'f') selected @endif>Kobieta</option>
                                            <option value="m" @if ($user->sex == 'm') selected @endif>Mężczyzna</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type="submit" class="btn btn-primary pull-right">Zapisz</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

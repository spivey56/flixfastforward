@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Create New Intro</h1>
        <hr/>

        {!! Form::open(['url' => '/admin/intros', 'class' => 'form-horizontal']) !!}

        <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
            {!! Form::label('user_id', 'User Id', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('user_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::textarea('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('start_time') ? 'has-error' : ''}}">
            {!! Form::label('start_time', 'Start Time', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('start_time', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('start_time', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
            {!! Form::label('duration', 'Duration', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('duration', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

    </div>
@endsection
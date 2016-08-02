@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Intro {{ $intro->id }}
        <a href="{{ url('admin/intros/' . $intro->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Intro"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/intros', $intro->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Intro',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $intro->id }}</td>
                </tr>
                <tr><th> User Id </th><td> {{ $intro->user_id }} </td></tr><tr><th> Title </th><td> {{ $intro->title }} </td></tr><tr><th> Duration </th><td> {{ $intro->duration }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection

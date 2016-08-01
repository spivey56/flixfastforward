@extends('layouts.app')

@section('content')
    @if(isset($intros))
    <div class="container">

        <h1>Intros <a href="{{ url('/admin/intros/create') }}" class="btn btn-primary btn-xs"
                      title="Add New Intro"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th> User Id</th>
                    <th> Title</th>
                    <th> Duration</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                    @foreach($intros as $item)
                        {{-- */$x++;/* --}}
                        <tr>
                            <td>{{ $x }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->duration }}</td>
                            <td>
                                <a href="{{ url('/admin/intros/' . $item->id) }}" class="btn btn-success btn-xs"
                                   title="View Intro"><span class="glyphicon glyphicon-eye-open"
                                                            aria-hidden="true"/></a>
                                <a href="{{ url('/admin/intros/' . $item->id . '/edit') }}"
                                   class="btn btn-primary btn-xs" title="Edit Intro"><span
                                            class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/intros', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Intro" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Intro',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ));!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $intros->render() !!} </div>
        </div>

    </div>

        @else
        <div style="text-align: center" class="alert-warning">
            No intros created yet!
        </div>

    @endif
@endsection

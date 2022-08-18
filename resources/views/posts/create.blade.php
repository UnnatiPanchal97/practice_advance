@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row m-auto">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>{{__('create post')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>{{__('customer.whoop')}}</strong>{{__('customer.inputProblem')}}<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {!! Form::open(['route' => 'posts.store', 'method' => 'post', 'name' => 'customerForm']) !!}
            {{ Form::token() }}

            <div class="row m-auto">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', '', ['class' => 'form-control','placeholder' => 'Name']) }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        {{ Form::label('name','Description') }}
                        {{ Form::textarea('description', null, ['class' => 'form-control','rows' => 3, 'name' => 'description']) }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
                </div>
            </div>

        {{ Form::close() }}
    </div>
</div>
@endsection

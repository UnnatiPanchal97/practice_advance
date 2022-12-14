@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row m-auto">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('posts') }}</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{route('posts.create')}}">{{__('newPost')}}</a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form method="GET" class="mb-5">
                <div class="input-group mb-3">
                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
            <table class="table table-bordered">
                <tr>
                    <th>{{__('No')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Description')}}</th>
                    <th  width="250px">{{__('Action')}}</th>
                </tr>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->description }}</td>

                    <td class="text-center">
                    {{ Form::open(array('route' => array('posts.destroy', $post->id))) }}
                    <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">{{__('show')}}</a>
                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">{{__('edit')}}</a>
                            {{ Form::token() }}
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{__('delete')}}</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $posts->links() !!}
        </div>
    </div>
</div>
@endsection

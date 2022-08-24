@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row m-auto">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('blogs') }}</h2>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>{{__('No')}}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Created By')}}</th>
                </tr>
                @foreach ($blogs as $blog)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->description }}</td>
                    <td>{{ $blog->user->name }}</td>
                </tr>
                @endforeach
            </table>
            {!! $blogs->links() !!}
        </div>
    </div>
</div>
@endsection

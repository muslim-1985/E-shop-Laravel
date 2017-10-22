@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Post</h1>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ $post->id }}</h3>
                    <h3>{{ $post->title }}</h3>
                    <p>
                        @if(isset($post->category->title))
                            {{ $post->category->title }}
                        @else {{ "Без категории" }}
                        @endif
                    </p>
                    <p>{{ $post->desc }}</p>
                    <p>
                        @foreach($post->tags as $tag)
                            {{ $tag->title }}
                        @endforeach
                    </p>
                    <p>{{ $post->slug }}</p>
                    <p>
                        @foreach($images as $image)
                            <img src="{{asset("/storage/app/$image" )}}" alt="No image">
                        @endforeach
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <dl class="dl-horisontal">
                            <dt>Created at:</dt>
                            <dd>{{ date('M j,Y', strtotime($post->created_at ))}}</dd>
                        </dl>
                        <dl class="dl-horisontal">
                            <dt>Last updated:</dt>
                            <dd>{{ date('M j,Y', strtotime($post->updated_at ))}}</dd>
                        </dl>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ action('Admin\PostController@edit', $post->id) }}" class="btn btn-default btn-block">Edit</a>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::model($post,['method' => 'DELETE','action' => ['Admin\PostController@destroy',$post->id],'style'=>'display:inline']) !!}

                                <button type="submit" style="display: inline;" class="btn btn-danger btn-block">Delete</button>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
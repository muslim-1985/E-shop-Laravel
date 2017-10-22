@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Category</h1>
            </div>
            <div class="row">
                {{-- не забываем добавлять атрибут для загрузки фалов "multipart/formdata ('files'=> true)" --}}
                {!! Form::model($post,['method' => 'PATCH', 'action' => ['Admin\PostController@update',$post->id],'files' => true]) !!}
                <div class="col-md-8">
                    {{ Form::label('title', 'Заголовок') }}
                    {{ Form::text('title', null, array('class' => 'form-control', 'maxlength' => '150')) }}

                    {{ Form::label('desc', 'Description') }}
                    {{ Form::textarea('desc', null, array('class' => 'form-control', 'maxlength' => '250')) }}


                    {{ Form::label('content', 'Content') }}
                    {{ Form::textarea('content', null, array('class' => 'form-control')) }}
                    <div class="col-md-2">
                        {{ Form::label('tags', 'Tags:') }}
                        <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" style="width: 100%;">
                            @foreach($post->tags as $tag)
                                <option value="{{ $tag->id }}"selected>{{ $tag->title }}</option>
                            @endforeach
                            @foreach($tags as $tag)
                                <option id="tag_id" value="{{$tag->id}}">{{ $tag->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">

                        {{ Form::label('cat_id', 'Category:') }}
                        <select class="form-control" name="cat_id">
                            <option value=" " selected></option>
                            @foreach($categories as $cat)
                                <option id="cat_id" value="{{$cat->id}}">{{ $cat->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        {{ Form::label('slug', 'Slug:') }}
                        {{ Form::text('slug', null, array('class' => 'form-control', 'maxlength' => '100')) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::label('img', 'Images:') }}
                        <input type="file" name="img[]"  multiple="multiple" >
                    </div>
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
                                <a href="{{ action('Admin\PostController@show', $post->id) }}" class="btn btn-default btn-block">Cansel</a>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::submit('Save changes', ['class'=>'btn btn-success btn-block']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
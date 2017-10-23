@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Product</h1>
            </div>
            <div class="row">
                {{-- не забываем добавлять атрибут для загрузки фалов "multipart/formdata ('files'=> true)" --}}
                {!! Form::model($product,['method' => 'PATCH', 'route' => ['admin.prod.update',$product->id],'files' => true]) !!}
                <div class="col-md-8">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '150')) }}

                    {{ Form::label('desc', 'Description') }}
                    {{ Form::textarea('desc', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '250')) }}

                    <div class="col-md-3">
                        {{ Form::label('tags', 'Tags:') }}
                        <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" style="width: 100%;">
                            @foreach($product->tags as $tag)
                                <option value="{{ $tag->id }}"selected>{{ $tag->title }}</option>
                            @endforeach
                            @foreach($tags as $tag)
                                <option id="tag_id" value="{{$tag->id}}">{{ $tag->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">

                        {{ Form::label('cat_id', 'Category:') }}
                        <select class="form-control" name="cat_id">
                            <option value=" " selected></option>
                            @foreach($categories as $cat)
                                <option id="cat_id" value="{{$cat->id}}" selected="selected">{{ $cat->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        {{ Form::label('slug', 'Slug:') }}
                        {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '100')) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('img', 'Images:') }}
                        <input type="file" name="img[]"  multiple="multiple" >
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            {{ Form::label('brand_id', 'Brand:') }}
                            <select class="form-control" name="cat_id">
                                @foreach($brands as $brand)
                                    <option id="brand_id" value="{{$brand->id}}" selected="selected">{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('qti','quantity') }}
                            {{ Form::text('qti', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '100')) }}
                        </div>
                        <div class="col-md-4">

                            {{ Form::label('hit')}}
                            {{ Form::checkbox('hit',0, false) }}


                            {{Form::label('new') }}
                            {{ Form::checkbox('new',0, false) }}

                        </div>
                        <div class="col-md-4">
                            {{ Form::label('price','price') }}
                            {{ Form::text('price', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '100')) }}
                        </div>
                    </div>

                <div class="col-md-4">
                    <div class="well">
                        <dl class="dl-horisontal">
                            <dt>Created at:</dt>
                            <dd>{{ date('M j,Y', strtotime($product->created_at ))}}</dd>
                        </dl>
                        <dl class="dl-horisontal">
                            <dt>Last updated:</dt>
                            <dd>{{ date('M j,Y', strtotime($product->updated_at ))}}</dd>
                        </dl>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('admin.prod.show', $product->id) }}" class="btn btn-default btn-block">Cansel</a>
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
    </div>
@endsection
@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- не забываем добавлять атрибут для загрузки фалов "multipart/formdata ('files'=> true)" --}}
                {!! Form::open(['url' => 'admin/product/store', 'files' => true]) !!}
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '150')) }}

                {{ Form::label('desc', 'Description') }}
                {{ Form::textarea('desc', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '250')) }}

                <div class="col-md-3">
                    {{ Form::label('tags', 'Tags:') }}
                    <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" style="width: 100%;">
                        @foreach($tags as $tag)
                            <option id="tag_id" value="{{$tag->id}}">{{ $tag->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">

                    {{ Form::label('cat_id', 'Category:') }}
                    <select class="form-control" name="cat_id">
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
                        {{Form::label('approved')}}
                        {{ Form::checkbox('approved',0, false) }}

                        {{ Form::label('hit')}}
                        {{ Form::checkbox('hit',0, false) }}


                        {{Form::label('new') }}
                        {{ Form::checkbox('new',0, false) }}

                    </div>
                </div>


                {{ Form::submit('Create Product', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 80px;')) }}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

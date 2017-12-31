@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- не забываем добавлять атрибут для загрузки фалов "multipart/formdata ('files'=> true)" --}}
                {!! Form::open(['url' => 'admin/product/store', 'files' => true, 'data-parsley-validate'=>'']) !!}
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
                        <option value=" " selected></option>
                        {{--в переменной $rootCategories записан метод выборки категорий без родителя
                              из модели Category
                              return $this->where('parent_id',null)->with('childs')->get();--}}
                        @foreach($rootCategories as $cat)
                            <option id="cat" value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @if($cat->childs)
                                <ul>
                                    @include('admin.product.cat-tree',['children'=>$cat->childs])
                                </ul>
                            @endif
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('cat_id') }}</small>
                </div>

                <div class="col-md-3">
                    {{ Form::label('slug', 'Slug:') }}
                    {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '100')) }}
                </div>
                <div class="col-md-3">
                    {{ Form::label('img', 'Images:') }}
                    <input type="file" name="img[]"  multiple="multiple" >
                    <small class="text-danger">{{ $errors->first('img') }}</small>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        {{ Form::label('brand_id', 'Brand:') }}
                        <select class="form-control" name="brand_id">
                            @foreach($brands as $brand)
                                <option id="brand_id" value="{{$brand->id}}" selected="selected">{{ $brand->title }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('brand_id') }}</small>
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('qti','quantity') }}
                        {{ Form::text('qti', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '100', 'data-parsley-type'=>'number')) }}
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


                {{ Form::submit('Create Product', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 80px;')) }}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/category/store','files'=>true,'data-parsley-validate'=>'']) !!}
                {{ Form::label('parent_id', 'Parent Category:') }}
                <select class="form-control" name="parent_id">
                    <option value=" " selected></option>
                    {{--в переменной $rootCategories записан метод выборки категорий без родителя
                          из модели Category
                          return $this->where('parent_id',null)->with('childs')->get();--}}
                    @foreach($rootCategories as $cat)
                        <option id="cat" value="{{ $cat->id }}">{{ $cat->title }}</option>
                        @if($cat->childs)
                            <ul>
                                @include('admin.category.cat-tree',['children'=>$cat->childs])
                            </ul>
                        @endif
                    @endforeach
                </select>
                {{ Form::label('title', 'Название') }}
                {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '150')) }}

                {{ Form::label('desc', 'Описание') }}
                {{ Form::textarea('desc', null, array('class' => 'form-control', 'required' => '')) }}
                <div class="col-md-6">
                    {{ Form::label('slug', 'Слаг') }}
                    {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '150')) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label('img', 'Image:') }}
                    <input type="file" name="img">
                </div>


                {{ Form::submit('Создать Категорию', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 80px;')) }}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
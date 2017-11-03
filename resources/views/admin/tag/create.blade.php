@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => 'admin.brand.store','files'=>true,'data-parsley-validate'=>'']) !!}

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


                {{ Form::submit('Создать Бренд', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 80px;')) }}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
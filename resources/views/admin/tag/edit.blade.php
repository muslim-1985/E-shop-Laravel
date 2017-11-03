@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Brand</h1>
            </div>
            <div class="row">
                {!! Form::model($brand,['method' => 'PATCH', 'route' => ['admin.brand.update',$brand->id],'files'=>true]) !!}
                <div class="col-md-8">
                    {!! Form::open(['url' => 'admin/brand/store','files'=>true,'data-parsley-validate'=>'']) !!}

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
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <dl class="dl-horisontal">
                            <dt>Created at:</dt>
                            <dd>{{ date('M j,Y', strtotime($brand->created_at ))}}</dd>
                        </dl>
                        <dl class="dl-horisontal">
                            <dt>Last updated:</dt>
                            <dd>{{ date('M j,Y', strtotime($brand->updated_at ))}}</dd>
                        </dl>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('admin.brand.show', $brand->id) }}" class="btn btn-default btn-block">Cansel</a>
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
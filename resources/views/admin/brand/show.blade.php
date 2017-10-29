@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Brand</h1>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3>id: {{ $brand->id }}</h3>
                    <h3>Name: {{ $brand->title }}</h3>
                    <h3>Slug: {{ $brand->slug }}</h3>
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
                                    <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-default btn-block">Edit</a>
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::model($brand,['method' => 'DELETE','route' => ['admin.brand.delete',$brand->id],'style'=>'display:inline']) !!}

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
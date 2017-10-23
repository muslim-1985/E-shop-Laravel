@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Product</h1>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ $product->id }}</h3>
                    <h3>{{ $product->title }}</h3>
                    <p>
                        @if(isset($product->category->title))
                            {{ $product->category->title }}
                        @else {{ "Без категории" }}
                        @endif
                    </p>
                    <p>{{ $product->desc }}</p>
                    <p>
                        @foreach($product->tags as $tag)
                            {{ $tag->title }}
                        @endforeach
                    </p>
                    <p>{{ $product->slug }}</p>
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
                            <dd>{{ date('M j,Y', strtotime($product->created_at ))}}</dd>
                        </dl>
                        <dl class="dl-horisontal">
                            <dt>Last updated:</dt>
                            <dd>{{ date('M j,Y', strtotime($product->updated_at ))}}</dd>
                        </dl>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ action('Admin\ProductController@edit', $product->id) }}" class="btn btn-default btn-block">Edit</a>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::model($product,['method' => 'DELETE','action' => ['Admin\ProductController@destroy',$product->id],'style'=>'display:inline']) !!}

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
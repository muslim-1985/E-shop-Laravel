@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ route('admin.prod.create') }}" class="btn btn-primary btn-xs pull-right">+Create Product</a>
                        My Products
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>category</th>
                        <th>description</th>
                        <th>tag</th>
                        <th>slug</th>
                        <th>orders</th>
                        <th>brand</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>hit</th>
                        <th>new</th>
                        <th>images</th>
                        <th>created at</th>
                        <th>actions</th>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th>{{ $product->id }}</th>
                                <td>{{ $product->title }}</td>
                                <td>
                                    @if(isset($product->category->title))
                                        {{-- фильтрация категорий. Передаем айдишник категории методу контроллера PostController CategoryFilter --}}
                                        <a href="{{ route('admin.category.filter',$product->category->id) }}">{{ $product->category->title }}</a>
                                    @else {{ "Без категории" }}
                                    @endif
                                </td>
                                <td>{{ $product->desc }}</td>
                                <td>
                                    @foreach($product->tags as $tag)
                                        <a href="{{ route('admin.tag.filter',$tag->id) }}">{{ $tag->title }}</a>
                                    @endforeach
                                </td>
                                <td>{{ $product->slug }}</td>
                                <td>
                                    {{--сохраняем id товара на фронтенде во время заказа товара с помощью скрытого поля
                                    куда передаються айдишники
                                    далее мы их вылавливаем request и вызываем модель товара и сохраняем в
                                    промежуточной таблице--}}
                                    @foreach($product->orders as $order)
                                        {{ $order->id }}
                                    @endforeach
                                </td>
                                <td>{{ $product->brand['title'] }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->qti }}</td>
                                <td>
                                    <a href="{{ route('admin.hit.filter') }}">
                                        @if($product->hit === 1)
                                            <strong>hit</strong>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.new.filter') }}">
                                        @if($product->hit === 1)
                                            <strong>new</strong>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    @foreach(explode(' ', $product->img) as $image)
                                        <img src="{{asset("images/$image" )}}" alt="No image" style="width: 50px; height: 50px;">
                                    @endforeach
                                </td>
                                <td>{{ date('M j,Y', strtotime($product->created_at ))}}</td>
                                <td>
                                    <a href="{{ route('admin.prod.edit', $product->id) }}" class="btn btn-default btn-xs">Edit</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['admin.prod.delete',$product->id],'style'=>'display:inline']) !!}

                                    <button type="submit" style="display: inline;" class="btn btn-danger btn-xs">Delete</button>

                                    {!! Form::close() !!}
                                    <a href="{{ route('admin.prod.show', $product->id) }}" class="btn btn-success btn-xs">Show</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-offset-5 col-md-6">
                        {{--вывод пагинации--}}
                        {{-- $product->links()--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
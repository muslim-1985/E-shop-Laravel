@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Customer Order Cart</h1>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h5><strong>id: </strong>{{ $order->id }}</h5>
                    <h5><strong>name: </strong>{{ $order->customer_name }}</h5>
                    <h5><strong>email: </strong>{{ $order->customer_email }}</h5>
                    <h5><strong>phone: </strong>{{ $order->customer_phone }}</h5>
                    <h5><strong>total: </strong>{{ $order->total }}</h5>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>id</th>
                            <th>name</th>
                            <th>category</th>
                            <th>brand</th>
                            <th>price (accentual)</th>
                            <th>quantity (order)</th>
                            <th>quantity (in stock)</th>
                            <th>sum</th>
                        </thead>
                        <tbody>
                        {{--создаем индекс товаров в цикле($key) для того чтобы можно было бы связать по индексу
                            актуальную стомость, количество, сумму с самим товаром--}}
                        @foreach($order->products as $key => $product)
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
                                <td>{{ $product->brand->title }}</td>
                                {{--Достаем из БД по индексу актуальные данные. В массив они преобразуются автоматически
                                    благодаря встроенному в Ларавел свойству $casts в модели Order --}}
                                <td>{{ $order->price[$key] }}</td>
                                <td>{{ $order->qti[$key] }}</td>
                                <td>{{ $product->qti }}</td>
                                <td>{{ $order->sum[$key] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
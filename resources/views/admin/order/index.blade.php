@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Orders</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>created at</th>
                        <th>approved</th>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th>{{ $order->id }}</th>
                                <td><a href="{{ route('admin.brand.filter',$order->id) }}">{{ $order->customer_name }}</a></td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>{{ $order->customer_email }}</td>
                                <td>{{ date('M j,Y', strtotime($order->created_at ))}}</td>
                                <td>
                                    @if($order->approved == 1)
                                        оплаче {{$order->approved}}
                                    @else
                                        не оплачен {{$order->approved}}
                                    @endif
                                    {{-- обновление чекбокса, отправляем форму по созданному роуту и обновляем значение чекбокса --}}
                                    {!! Form::open(['method' => 'PATCH','route' => ['admin.order.approved',$order->id],'files'=>true]) !!}
                                    {!! Form::checkbox('approved',1,old('approved')) !!}
                                </td>
                                <td>

                                    <button type="submit" style="display: inline;" class="btn btn-danger btn-xs">Approved</button>

                                {!! Form::close() !!}
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['admin.order.delete',$order->id],'style'=>'display:inline']) !!}

                                    <button type="submit" style="display: inline;" class="btn btn-danger btn-xs">Delete</button>

                                    {!! Form::close() !!}
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-success btn-xs">Show</a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
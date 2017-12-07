@extends('attachment/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul>
                    @foreach($cart as $val)
                        <div class="col-md-6">
                            <li><strong>Name:</strong> {{ $val['title'] }}</li>
                            <li><strong>Price:</strong> {{ $val['price'] }}</li>
                            <li><strong>Quantity:</strong> {{ $val['qty'] }}</li>
                            <li><strong>Sum:</strong> {{ $val['sum'] }}</li>
                        </div>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h4>total:{{ $total }}</h4>
            </div>
        </div>
        <div class="row">
            {!! Form::open(['route' => 'front.order.store','data-parsley-validate'=>'']) !!}

            <div class="col-md-6">
                {{ Form::label('customer_name', 'Name') }}
                {{ Form::text('customer_name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '100')) }}
            </div>
            <div class="col-md-6">
                {{ Form::label('customer_email', 'Email:') }}
                {{ Form::email('customer_email', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '100')) }}
            </div>
            <div class="col-md-6">
                {{ Form::label('customer_phone', 'Phone:') }}
                {{ Form::text('customer_phone', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '100')) }}
            </div>
            {{--сохраняем айдишники товаров из сессии в связующей таблице (отношение многие ко многим)--}}
             @foreach($cart as $val)
                <input name="products[]" type="hidden" value="{{ $val['id'] }}">
                <input name="qti[]" type="hidden" value="{{ $val['qty'] }}">
                <input name="sum[]" type="hidden" value="{{ $val['sum'] }}">
             @endforeach
            <input name="total" type="hidden" value="{{ $total }}">
            <div class="col-md-2" style="margin-top: 30px">
                {{ Form::submit('Заказать', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 80px;')) }}
            </div>

            {!! Form::close() !!}

            <div class="col-md-6"></div>
            <div class="col-md-6"></div>
        </div>
    </div>
@endsection
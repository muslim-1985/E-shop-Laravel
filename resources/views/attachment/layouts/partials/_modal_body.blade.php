<table class="table table-bordered table-striped table-responsive">
    <thead>
    <th>No</th>
    <th>name</th>
    <th>quantity</th>
    <th>price</th>
    <th>sum</th>
    <th>actions</th>
    </thead>
    <tbody>
    @foreach($products as $product)
    <tr>
        <td>1</td>
        <td>{{ $product['title'] }}</td>
        <td class="qty">
            <span id="minus"
                  data-url="{{ route('front.del.qty',$product['id']) }}"> minus</span>
                    {{ $product['qty'] }}
            <span id="plus"
                  data-url="{{ route('front.add.qty',$product['id']) }}"> plus</span>
        </td>
        <td>{{ $product['price'] }}</td>
        <td>{{ $product['sum'] }}</td>

        <td class="delete">
            <button type="button" id="del" data-url = {{ route('front.cart.delete',$product['id']) }} class="btn btn-xs">Delete</button>
        </td>
    </tr>
    @endforeach
    <tr>
        <td>
            <strong>total:
                {{--Здесь мы применяем коллекции ларавел (метод reduce) для удобства вычислений. Окончательная сумма --}}
                {{
                    collect(session()->get('cart'))->reduce(function ($carry, $item)
                    {
                        return $carry + $item['sum'];
                    })
                }}
            </strong>
        </td>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </tr>
    </tbody>
</table>
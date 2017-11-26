<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    @include('attachment/layouts/partials/_nav')
        @yield('content')
    @include('attachment/layouts/partials/_footer')
</body>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.modal-body').on('click','#minus',function(e){
            e.preventDefault();
            var url = $(this).data('url');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: url,
                success: function (responce) {
                    showCart(responce);
                }
            })
        });
        $('.modal-body').on('click','#plus',function(e){
            e.preventDefault();
            var url = $(this).data('url');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: url,
                success: function (responce) {
                    showCart(responce);
                }
            })
        });
        $('.modal-body').on('click','#del',function(e){
          e.preventDefault();
          var url = $(this).data('url');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          $.ajax({
              type: 'DELETE',
              url: url,
              success: function (responce) {
                  showCart(responce);
              }
          })
        });

        function showCart(cart) {
            $('.modal-body').html(cart);
        }

        $('.add-to-cart').on('click',function (e) {
            e.preventDefault();
            var i = 0;
            var url = $(this).data('url');
            var id = $(this).data('id');
            var title = $(this).data('title');
            var price = $(this).data('price');
            var qty = $(this).data('qty');
            var sum = $(this).data('sum');
            $.ajax({
                url: url,
                data: {
                    id: id,
                    title: title,
                    price: price,
                    qty: qty,
                    sum: sum,
                },
                type: 'GET',
                success: function (responce) {
                    if (!responce) alert(id);
                    alert('Ваш товар успешно добавлен в корзину');
                    showCart(responce);
                }
            });
        });

    });
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('js/price-range.js') }}"></script>
<script src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</html>
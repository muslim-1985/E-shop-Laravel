
@extends('attachment/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="chat-res">
                    @if($messages)
                        @foreach($messages as $message)
                            <li>
                                <small>{{ $message->author }}</small>
                                </br>
                                {{ $message->content }}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-md-12">
                {!! Form::open(['route' => 'chat.store']) !!}
                {{ csrf_field() }}
                {{ Form::label('author', 'author') }}
                {{ Form::text('author', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '150')) }}

                {{ Form::label('content', 'message') }}
                {{ Form::textarea('content', null, array('class' => 'form-control', 'required' => '')) }}
                <div class="col-md-2">
                    {{ Form::submit('Send', array('class' => 'btn btn-success btn-sm btn-block', 'style' => 'margin-top: 30px;')) }}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        let socket = io(':6001');

        function appendMessagedata(data) {
            $('.chat-res').append(
                $('<li/>').append(
                    $('small').text(data.author),
                    $('p').text(data.content)
                )
            )
        }
        {{--отлавливаем событие из chat.server/server.js и выводим на экран--}}
        socket.on('chat:message', (data)=>{
            appendMessagedata(data);
        })
    </script>
@endsection
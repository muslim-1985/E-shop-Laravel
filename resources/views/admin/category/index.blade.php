@extends('admin/layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>View Categories</h1>
                <a href="{{ route('admin.cat.create') }}" class="btn btn-default">Create Category</a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>id</th>
                            <th>name</th>
                            <th>description</th>
                            <th>slug</th>
                            <th>parent cat</th>
                            <th>image</th>
                            <th>created at</th>
                            <th>approved</th>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                                <tr>
                                    <th>{{ $cat->id }}</th>
                                    <td><a href="{{ route('admin.parent.category.filter',$cat->id) }}">{{ $cat->title }}</a></td>
                                    <td>{{ $cat->desc }}</td>
                                    <td>{{ $cat->slug }}</td>
                                    <td>
                                        @if(isset($cat->parent))
                                            <a href="{{ route('admin.parent.category.filter',$cat->parent->id) }}">{{ $cat->parent->title }}</a>
                                            @else без род. категории
                                        @endif
                                    </td>
                                    <td><img src="{{ asset("images/$cat->img") }}" alt="no image" style="width: 50px;"></td>
                                    <td>{{ date('M j,Y', strtotime($cat->created_at ))}}</td>
                                    <td>
                                        @if($cat->approved == 1)
                                            опубликован {{$cat->approved}}
                                        @else
                                            не опубликован {{$cat->approved}}
                                        @endif
                                        {{-- обновление чекбокса, отправляем форму по созданному роуту и обновляем значение чекбокса --}}
                                        {!! Form::open(['method' => 'PATCH','route' => ['admin.cat.approved',$cat->id],'files'=>true]) !!}
                                        {!! Form::checkbox('approved',1,old('approved')) !!}
                                    </td>
                                    <td>

                                        <button type="submit" style="display: inline;" class="btn btn-danger btn-sm">Approved</button>

                                    {!! Form::close() !!}
                                    <td>
                                        <a href="{{ route('admin.cat.edit', $cat->id) }}" class="btn btn-default btn-sm">Edit</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['admin.cat.delete',$cat->id],'style'=>'display:inline']) !!}

                                        <button type="submit" style="display: inline;" class="btn btn-danger btn-sm">Delete</button>

                                        {!! Form::close() !!}
                                        <a href="{{ route('admin.cat.show', $cat->id) }}" class="btn btn-success btn-sm">Show</a>
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
@extends('layout')
@section('title')
    Поиск номера телефона
@endsection
@section('content')
    <style>
        ul.no-style {
            list-style: none;
        }

        .codes-list li {
            display: inline-block;
        }

        .codes-list li a {
            color: white;
        }
    </style>
    @include('search')
    <h2>В базе {{ $phones->total() }} номеров и {{$phoneInfosCount}} записей</h2>
    <h3>Выберите код оператора</h3>
    <ul class="codes-list no-style">
        @foreach($codes as $code)
            <li class="badge">
                <a href="./?code={{$code}}">{{ $code }}</a>
            </li>
        @endforeach
    </ul>

    <ul class="no-style">
        @foreach($phones as $phone)
            <li>
                <a href="/{{ $phone->number }}">{{ $phone->number }}</a>
            </li>
        @endforeach
    </ul>
    <div style="text-align: center;">
    {!!  $phones->render() !!}
    </div>
@endsection
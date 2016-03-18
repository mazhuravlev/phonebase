@extends('layout')
@section('title')
    {{ $phone }} - информация по номеру телефона
@endsection
@section('content')
    @include('search')
    <h1>Номер {{ $phone }}</h1>

@endsection
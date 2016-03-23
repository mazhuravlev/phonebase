@extends('layout')
@section('title')
    {{ $phoneNumber }} - информация по номеру телефона
@endsection
@section('content')
    @include('search')
    <h1>Номер {{ $phoneNumber }}</h1>
    @if($phone)
        <h4>
            <a href="http://{{ $phone->number }}.{{ env('APP_DOMAIN') }}">короткая ссылка на эту страницу</a>
        </h4>
    @endif
    @if($phone and $phone->phoneInfos->count() > 0)
        @foreach($phone->phoneInfos as $phoneInfo)
            <div class="panel panel-default">
                <div class="panel-body">
                    <span class="label">{{ $phoneInfo->source_id }}
                        : {{ $phoneInfo->created_at->format('d.m.Y') }}</span>
                    @foreach($phoneInfo->data as $key => $value)
                        @if($value)
                            <div>
                                <span class="badge">{{ trans('data.'.$key) }}</span>
                                {{ $value }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-warning">
            Информации по этому номеру не найдено.
        </div>
    @endif

    <div class="bs-component">
        <ul class="pager">
            <li class="previous @if(!$prev) disabled @endif"><a @if($prev) href="/{{ $prev->number }}" @endif>←
                    Предыдущий</a></li>
            <li class="next @if(!$next) disabled @endif"><a @if($next) href="/{{ $next->number }}" @endif>Следующий
                    →</a></li>
        </ul>
@endsection
@extends('layout')
@section('title')
    {{ $phoneNumber }} - информация по номеру телефона
@endsection
@section('content')
    @include('search')
    <h1>Номер {{ $phoneNumber }}</h1>
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
@endsection
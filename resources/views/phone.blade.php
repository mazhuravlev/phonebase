@extends('layout')
@section('title')
    {{ $phoneNumber }} - информация по номеру телефона
@endsection
@section('content')
    @include('search')
    <h1>Номер {{ $phoneNumber }}</h1>
    @if($phone and $phone->phoneInfos->count() > 0)
        <h3>Найдена информация по этому номеру</h3>
        @foreach($phone->phoneInfos as $phoneInfo)
            <div>
                <span class="label">{{ $phoneInfo->source_id }}: {{ $phoneInfo->created_at->format('d.m.Y') }}</span>
                @foreach($phoneInfo->data as $key => $value)
                    @if($value)
                        <div>
                            <span class="badge">{{ trans('data.'.$key) }}</span>
                            {{ $value }}
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    @else
        <div class="alert alert-warning">
            Информации по этому номеру не найдено.
        </div>
    @endif
@endsection
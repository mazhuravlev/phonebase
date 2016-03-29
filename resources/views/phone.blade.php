@extends('layout')
@section('description')
    <meta name="Description"
          content="Информация по номеру телефона {{ $phone->number }}
          @if($phone and $phone->phoneInfos()->count() > 0)
          {{ $phone->phoneInfos()->count() }} записи,
                @foreach($phone->phoneInfos()->first()->data as $key => $value)
          @if($value)
          {{ trans('data.'.$key) }}: {{ $value }}
          @endif
          @endforeach
          @else
                  нет информации
          @endif">
    <meta name="Keywords" content="{{ $phone->number }}, номер, телефон, кто звонил, olx, avito">
@endsection
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
    @else
        <h4>
            <a href="http://{{ $phoneNumber }}.{{ env('APP_DOMAIN') }}">короткая ссылка на эту страницу</a>
        </h4>
    @endif
    @if($phone and $phone->phoneInfos()->count() > 0)
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


    <div id="hypercomments_widget"></div>
    <script type="text/javascript">
        _hcwp = window._hcwp || [];
        _hcwp.push({
            widget: "Stream",
            widget_id: 72674,
            xid: "@if($phone){{ $phone->number }}@else{{ $phoneNumber }}@endif"
        });
        (function () {
            if ("HC_LOAD_INIT" in window)return;
            HC_LOAD_INIT = true;
            var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
            var hcc = document.createElement("script");
            hcc.type = "text/javascript";
            hcc.async = true;
            hcc.src = ("https:" == document.location.protocol ? "https" : "http") + "://w.hypercomments.com/widget/hc/72674/" + lang + "/widget.js";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hcc, s.nextSibling);
        })();
    </script>

    <div class="bs-component">
        <ul class="pager">
            <li class="previous @if(!$prev) disabled @endif"><a
                        @if($prev) href="{{ env('APP_URL') }}/{{ $prev->number }}" @endif>←
                    Предыдущий</a></li>
            <li class="next @if(!$next) disabled @endif"><a
                        @if($next) href="{{ env('APP_URL') }}//{{ $next->number }}" @endif>Следующий
                    →</a></li>
        </ul>
    </div>


    <!-- Put this script tag to the <head> of your page -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
    <script type="text/javascript">
        VK.init({apiId: 5174401, onlyWidgets: true});
    </script>
    <!-- Put this div tag to the place, where the Comments block will be -->
    <div id="vk_comments" style="width: 100%;"></div>
    <script type="text/javascript">
        VK.Widgets.Comments("vk_comments", {
            limit: 10,
            attach: "*"
        }, "@if($phone){{ $phone->number }}@else{{ $phoneNumber }}@endif");
    </script>


@endsection
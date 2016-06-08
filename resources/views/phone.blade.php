@extends('layout')
@section('description')
    <meta name="Description"
          content="Информация по номеру телефона {{ $phone->number }}
          @if($phone and $phone->phoneInfos()->count() > 0)
          {{ $phone->phoneInfos()->count() }} записи,
                @if(is_array($phone->phoneInfos()->first()->data) or $phone->phoneInfos()->first()->data instanceof Traversable)
          @foreach($phone->phoneInfos()->first()->data as $key => $value)
          @if($value)
          {{ trans('data.'.$key) }}: {{ $value }}
          @endif
          @endforeach
          @else
          {{var_dump($phone->phoneInfos()->first()->data)}}
          @endif

          @else
                  нет информации
          @endif">
    <meta name="Keywords"
          content="{{ $phone->number }}, {{ implode(', ', $phone->forms()) }}, номер, телефон, объявления, кто звонил, olx, avito">
@endsection
@section('title')
    {{ $phone->number }} - телефон: {{ implode(', ', $phone->forms()) }}. Информация и объявления по номеру телефона.
@endsection
@section('content')
    @include('search')
    <h1>Номер {{ $phoneNumber }}
        <small>({{ implode(', ', $phone->forms()) }})</small>
    </h1>
    @if($phone)
        <h4>
            <a href="http://{{ $phone->number }}.{{ env('APP_DOMAIN') }}">короткая ссылка на эту страницу</a>
        </h4>
    @else
        <h4>
            <a href="http://{{ $phoneNumber }}.{{ env('APP_DOMAIN') }}">короткая ссылка на эту страницу</a>
        </h4>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">Реклама</div>
        <div class="panel-body">
            @include('banners/adapt')
        </div>
    </div>

    @if($phone and $phone->phoneInfos()->count() > 0)
        @foreach($phone->phoneInfos as $phoneInfo)
            <div class="panel panel-default" style="font-size: 16px;">
                <style scoped>
                    .label, .badge {
                        font-size: 100%;
                    }

                    .label {
                        margin-bottom: 6px;
                    }
                </style>
                <div class="panel-body">
                    <span class="label">Добавлено на {{ $phoneInfo->source_id }}
                        : {{ $phoneInfo->created_at->format('d.m.Y') }}</span>
                    @if(is_array($phoneInfo->data) or $phoneInfo->data instanceof Traversable)
                        @foreach($phoneInfo->data as $key => $value)
                            @if($value)
                                @if('description' === $key)
                                    <div>
                                        <span class="badge">{{ trans('data.'.$key) }}</span>
                                        {{ mb_strimwidth($value, 0, 100, '...', 'UTF-8') }} <strong>
                                            <a class="btn btn-danger btn-raised"
                                               href="/phone/{{$phone->id}}/info/{{$phoneInfo->id}}">подробнее</a>
                                        </strong>
                                    </div>
                                @else
                                    <div>
                                        <span class="badge">{{ trans('data.'.$key) }}</span>
                                        {{ $value }}
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @else
                        {{ var_dump($phoneInfo->data) }}
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-warning">
            Информации по этому номеру не найдено.
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Реклама</div>
        <div class="panel-body">
            @include('banners/adapt')
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Реклама</div>
        <div class="panel-body">
            @include('banners/adapt')
        </div>
    </div>


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
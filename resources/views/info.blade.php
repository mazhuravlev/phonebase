@extends('layout')
@section('description')
    <meta name="Description"
          content="Информация по номеру телефона {{ $phone->number }}: {{ $phoneInfo }}">
    <meta name="Keywords"
          content="{{ $phone->number }}, {{ implode(', ', $phone->forms()) }}, номер, телефон, объявления, кто звонил, olx, avito">
@endsection
@section('title')
    {{ $phone->number }} - телефон: {{ implode(', ', $phone->forms()) }}. Информация и объявления по номеру телефона.
@endsection
@section('content')
    @include('search')
    <h1>Подробная информация по номеру {{ $phone->number }}
        <small>({{ implode(', ', $phone->forms()) }})</small>
    </h1>

    @include('banners/long')

    <div class="panel panel-default" style="font-size: 16px;">
        <style scoped>
            .label, .badge {
                font-size: 100%;
            }

            .label {
                margin-bottom: 6px;
            }
        </style>
        <div class="panel-heading">
            Подробная информация
        </div>
        <div class="panel-body">
            <span class="label">Добавлено на {{ $phoneInfo->source_id }}
                : {{ $phoneInfo->created_at->format('d.m.Y') }}</span>
            @if(is_array($phoneInfo->data) or $phoneInfo->data instanceof Traversable)
                @foreach($phoneInfo->data as $key => $value)
                    @if($value)
                        <div>
                            <span class="badge">{{ trans('data.'.$key) }}</span>
                            {{ $value }}
                        </div>
                    @endif
                @endforeach
            @else
                {{ var_dump($phoneInfo->data) }}
            @endif
            @if(\App\System\Source::hasUrl($phoneInfo->source_id))
                <strong>
                    <a target="_blank"
                       href="{{ \App\System\Source::url($phoneInfo->source_id, $phoneInfo->id_source) }}">Открыть
                        на {{$phoneInfo->source_id}}</a>
                    (может быть недоступно)
                </strong>
            @endif
        </div>
    </div>

    @include('banners/big1')
    @include('banners/adapt')

    <div id="hypercomments_widget"></div>
    <script type="text/javascript">
        _hcwp = window._hcwp || [];
        _hcwp.push({
            widget: "Stream",
            widget_id: 72674,
            xid: "{{ $phone->number }}"
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
            <li class="previous">
                <strong style="font-size: 18px;"><a href="{{ env('APP_URL') }}/{{ $phone->number }}">←Назад</a></strong>
            </li>
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
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

        .more-info {
            background-color: #5b7fa6;
            color: white;
            padding: 2px;
        }
    </style>
    @include('search')
    <h1>В базе {{ $phones->total() }} номеров и {{$phoneInfosCount}} записей</h1>

    <div id="hypercomments_widget"></div>
    <script type="text/javascript">
        _hcwp = window._hcwp || [];
        _hcwp.push({
            widget: "Stream",
            widget_id: 72674,
            xid: "index"
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

    <!-- Put this script tag to the <head> of your page -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

    <script type="text/javascript">
        VK.init({apiId: 5174401, onlyWidgets: true});
    </script>

    <!-- Put this div tag to the place, where the Comments block will be -->
    <div id="vk_comments" style="width: 100%;"></div>
    <script type="text/javascript">
        VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"}, "index");
    </script>

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
    <div class="panel panel-default">
        <div class="panel-heading">Реклама</div>
        <div class="panel-body">
            @include('banners/adapt')
        </div>
    </div>
    <ul class="no-style">
        @foreach($phones as $phone)
            <li style="margin-bottom: 6px;">
                <a href="/{{ $phone->number }}">{{ $phone->number }}</a>
                <small>{{ implode(', ', $phone->forms()) }}</small>
                {{$phoneInfoCount = $phone->phoneInfos()->count()}}
                @if($phoneInfoCount)
                    <span>
                        @if(is_array($phone->phoneInfos->first()->data))
                            @foreach($phone->phoneInfos->first()->data as $key => $value)
                                @if($value)
                                    <span class="badge">{{ trans('data.'.$key) }}</span>
                                    {{ mb_strimwidth($value, 0, 50, '…') }}
                                @endif
                            @endforeach
                        @else
                            <button class="btn btn-danger">Ошибка!</button>
                        @endif
                    </span>
                    @if($phoneInfoCount > 1)
                        <a class="more-info" href="/{{ $phone->number }}">+{{$phoneInfoCount - 1}} инф</a>
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
    <div style="text-align: center;">
        {!!  $phones->render() !!}
    </div>
@endsection
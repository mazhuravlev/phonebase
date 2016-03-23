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


    <h3>Выберите код оператора</h3>
    <ul class="codes-list no-style">
        @foreach($codes as $code)
            <li class="badge">
                <a href="./?code={{$code}}">{{ $code }}</a>
            </li>
        @endforeach
    </ul>

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
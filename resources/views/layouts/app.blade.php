<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript">
        var litepmsembed_id=9019,
            litepms_id=9019,
            litepms_wid=1864,
            mode='embed',
            embed_url='https://xn--b1acevcupew.xn--p1ai/booking',
            form_title='Забронировать номер',
            button_value='Поиск номеров';
        var lpmsrid
    </script>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @seo
    <link rel="shortcut icon" href="{{asset('img/favicon_8.ico')}}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/fonts.css')}}">

{{--    <!-- Select2 -->--}}
{{--    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">--}}
{{--    <!-- Select2 -->--}}

{{--    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>--}}
{{--    <script type="text/javascript"--}}
{{--            src="https://api-maps.yandex.ru/2.1/?apikey={{config('config.api_key')}}&lang=ru_RU"></script>--}}


{{--    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}

{{--    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>--}}


{{--    <script src="{{asset('/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>--}}

    <script src="https://app.reviewlab.ru/widget/index-es2015.js" defer></script>

    {{--    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">--}}


    @vite(['resources/js/app.js'])
    <script>
        let settingsSite = @json($settings);
    </script>
    <style>
        @media only screen and (max-width: 767px) {
            .vh-100{
                height: 100vh;
            }
            .m-w-10 {
                width: 10% !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .m-w-15 {
                width: 15% !important;
            }

            .m-w-20 {
                width: 20% !important;
            }

            .m-w-80 {
                width: 80% !important;
            }

            .m-w-85 {
                width: 85% !important;
            }

            .m-w-90 {
                width: 90% !important;
                display: flex;
                align-items: center;
                padding-bottom: .5rem;
            }
        }

    </style>

</head>
<body>


<div id="app">


</div>

<script async="" src="https://cdn-ru.bitrix24.ru/b22588726/crm/tag/call.tracker.js?29301693"></script>
<script async="" src="https://cdn-ru.bitrix24.ru/b22588726/crm/site_button/loader_4_vho90i.js?29301693"></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(95626494, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/95626494" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script>
    (function(w,d,u){
        var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
        var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
    })(window,document,'https://cdn-ru.bitrix24.ru/b22588726/crm/site_button/loader_4_vho90i.js');
</script>
<!-- pixel -->
<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src='https://vk.com/js/api/openapi.js?173',t.onload=function(){VK.Retargeting.Init("VK-RTRG-1827348-83d8X"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-1827348-83d8X" style="position:fixed; left:-999px;" alt=""/></noscript>
<!-- /pixel -->
</body>
</html>






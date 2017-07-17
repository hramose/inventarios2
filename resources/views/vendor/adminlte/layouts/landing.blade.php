<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@lang('home.descripcion')">
    <meta name="author" content="Wagner Alexander Cadena Lastra">

    <link rel="icon" type="image/png" href="{{ asset('/favicon.ico') }}">
    <link rel="icon"
          type="image/png"
          href="{{ asset('/favicon.ico') }}" />
    <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/png" />
    <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/png" />

    <meta property="og:title" content="@lang('home.sesinvetecu')" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="@lang('home.descripcion')" />
    <meta property="og:url" content="@lang('home.url')" />
    <meta property="og:image" content="@lang('home.url')img/AcachaAdminLTE.png" />
    <meta property="og:image" content="@lang('home.url')img/AcachaAdminLTE600x600.png" />
    <meta property="og:image" content="@lang('home.url')img/AcachaAdminLTE600x314.png" />
    <meta property="og:sitename" content="@lang('home.sesinvetecu')" />
    <meta property="og:url" content="@lang('home.url')" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@acachawiki" />
    <meta name="twitter:creator" content="@acacha1" />

    <title>{{ trans('adminlte_lang::message.landingdescriptionpratt') }}</title>

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/all-landing.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

</head>

<body data-spy="scroll" data-target="#navigation" data-offset="50">

<div id="app" v-cloak>
    <!-- Fixed navbar -->
    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><b>adminlte-laravel</b></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#home" class="smoothScroll">@lang('home.men1')</a></li>
                    <li><a href="#desc" class="smoothScroll">Description</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                        <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    @else
                        <li><a href="/home">{{ Auth::user()->name }}</a></li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>


    <section id="home" name="home">
        <div id="headerwrap">
            <div class="container">
                <div class="row centered">
                    <div class="col-lg-12">
                        <h1>SES <b><a href="{{ url('/login') }}">Ecuador-Inventarios</a></b></h1>
                <h3>@lang('home.descripcion')</h3>
                <h3><a href="{{ url('/home') }}" class="btn btn-lg btn-success">@lang('home.comenzar')</a></h3>
                    </div>
                </div>
            </div> <!--/ .container -->
        </div><!--/ #headerwrap -->
    </section>

    <section id="desc" name="desc">
        <!-- INTRO WRAP -->
        <div id="intro">
            <div class="container">
                <div class="row centered">
                    <h1>Inventarios OnLine</h1>
                    <br>
                    <br>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro01.png') }}" alt="">
                        <h3>Conectados</h3>
                        <p>Siempre en linea los inventarios.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro02.png') }}" alt="">
                        <h3>Al Día</h3>
                        <p>Inventarios y estado de maquinas y a quien controla los activos.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro03.png') }}" alt="">
                        <h3>Monitoreo</h3>
                        <p>Monitorea los cambios de usuarios y activos .</p>
                    </div>
                </div>
                <br>
                <hr>
            </div> <!--/ .container -->
        </div><!--/ #introwrap -->


    </section>

    <footer>
        <div id="c">
            <div class="container">
                <p>
                    <a href="@lang('home.url')"></a><b>@lang('home.sesinvetecu')</b></a>. Sistema de Inventario de Activos y sus Usuarios.<br/>
                    <strong>Copyright &copy; 2016 <a href="http://acacha.org">Acacha.org</a>.</strong> Created by <a href="#">Wagner Cadena</a>.
                    <br/>
                    Desarrollo <a href="#">Aerogal</a>
                </p>

            </div>
        </div>
    </footer>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ url (mix('/js/app-landing.js')) }}"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>

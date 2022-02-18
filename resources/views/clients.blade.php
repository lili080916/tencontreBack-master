<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>tEncontré &middot;</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VXR0XEJY99"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-VXR0XEJY99');
    </script>

    <meta name="author" content="Sunrise Digital">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('clients/img/icono.png') }}">

    <!-- Bootstrap -->
    <link href="{{ asset('clients/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS Core-->
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="{{ asset('clients/css/phone.css') }}" />
    <link rel="stylesheet" media="screen and (min-width: 768px) and (max-width: 991px)" href="{{ asset('clients/css/tablet.css') }}" />
    <link rel="stylesheet" media="screen and (min-width: 992px)" href="{{ asset('clients/css/main.css') }}" />

    <link rel="stylesheet" href="{{ asset('clients/css/carousel.css') }}">

    <link href="{{ asset('clients/font-awesome-4.6.1/css/font-awesome.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Rubik:400,500,900,700' rel='stylesheet' type='text/css'> <!-- font-family: 'Rubik', sans-serif; -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600italic,600' rel='stylesheet' type='text/css'> <!-- font-family: 'Open Sans', sans-serif; -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
        .btn-default {
            box-shadow:0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #adadad, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
            background-color:#fff;
        }
        .btn3d {
            transition:all .08s linear;
            position:relative;
            outline:medium none;
            -moz-outline-style:none;
            border:0px;
            margin-right:10px;
            margin-top:15px;
        }
        .btn3d:focus {
            outline:medium none;
            -moz-outline-style:none;
        }
        .btn3d:active {
            top:9px;
        }
        .parpadea {
            animation-name: parpadeo;
            animation-duration: 1s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;

            -webkit-animation-name:parpadeo;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: linear;
            -webkit-animation-iteration-count: infinite;
        }

        @-moz-keyframes parpadeo{
            0% { opacity: 1.0; }
            50% { opacity: 1.0; }
            100% { opacity: 1.0; }
        }

        @-webkit-keyframes parpadeo {
            0% { opacity: 1.0; }
            50% { opacity: 0.0; }
            100% { opacity: 1.0; }
        }

        @keyframes parpadeo {
            0% { opacity: 1.0; }
            50% { opacity: 0.0; }
            100% { opacity: 1.0; }
        }
  </style>
  <body>

    <div class="brand"> <h1 class="h5"><i class="icon icon-app"></i> tEnconté<span> Portal</span></h1> </div>

    <nav>
    	<ul>
    		<li data-marker="1" class="parpadea active"></li>
    		<li data-marker="2" class="parpadea"></li>
    		<li data-marker="3" class="parpadea"></li>
            <li data-marker="4" class="parpadea"></li>
            <li data-marker="5" class="parpadea"></li>
            <li data-marker="6" class="parpadea"></li>
    		<li data-marker="7" class="parpadea"></li>
    	</ul>
    </nav>

    <div class="app-store-btns">
    	<a href="#app-store" class="app-store"><i></i></a>
    	<a href="#google-play" class="google-play"><i></i></a>
    </div>

    <div class="screens">
    	<div class="screen active" data-marker="1">
            <canvas></canvas>
            <div class="background"></div>

    		<div class="content-outside">
    			<div class="content-inside align-center">
                    <h1 class="text-one">tEncontré <br> App para Cuba </h1>
    				<h2 class="h5 text-one">Desarrollado por <br class="visible-xs"> <a href="https://codeals.es" target="_blank"> Codeals </a><br class="visible-xs"> StartUP de desarrollo</h2>
                    <br>

                    <div class="text-two">
                        <i class="icon icon-scroll"></i>
                        <a href="{{ route('update.app') }}" type="button" class="btn btn-default btn-lg btn3d"><img src="{{ asset('clients/img/icono.png') }}" alt="logo" title="logo" width="30px" heigth='30px'></img> Descargar</a>
                    </div>
    			</div>
    		</div>
    	</div>

    	<div class="screen" data-marker="2">
            <div class="background"></div>

    		<div class="content-outside">
    			<div class="content-inside align-left">
    				<div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 hidden-xs hidden-sm">
                                <div class="phones">
                                    <img src="{{ asset('clients/img/nexus.png') }}" alt="Google Nexus" class="nexus" />
                                    <img src="{{ asset('clients/img/iphone.png') }}" alt="iPhone 6" class="iphone"/>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="text">
                                    <h1 class="h4">App tEncontré <br> para iOs y Android</h1>
                                    <br>

                                    <p>
                                        Aplicación enfocada en la isla de Cuba,
                                        para encontrar productos y servicios de primera necesidad para la población.
                                        La idea es llevar a todos los cubanos el conocimiento de la ubicación de los diferentes
                                        productos y así contribuir a la ayuda a la población, evitándole largos desplazamientos
                                        y dándole en sus manos la posibilidad de saber la existencia de lo que anda buscando y el
                                        punto más cercano en donde adquirirlo.
                                        <br><br>

                                        Desrrollado por el equipo de <a href="https://codeals.es" target="_blank">Codeals</a>. ¡Colocamos tus ideas en la nube!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
    			</div>
    		</div>
    	</div>

    	<div class="screen" data-marker="3">
            <div class="background"></div>

    		<div class="content-outside">
    			<div class="content-inside">
    				<div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 align-center align-center-mobile">
                                <div class="text">
                                    <h1 class="h4"> <i class="icon icon-subscribe hidden-xs"></i> 1. Reportar </h1>
                                    <p>Para reportar productos seleccionamos el ícono de <strong>Reporte</strong>. (Clikeando el botón del celular de la imagen puede ver los pasos visualmente.)</p>

                                    <div class="hidden-xs">
                                        <br><br>
                                    </div>

                                    <h1 class="h4"><i class="icon icon-rent hidden-xs"></i> 2. Selección de productos </h1>
                                    <p>Seleccionamos los productos a reportar. La App tiene integrado búsquedas para encontrar productos.Puede seleccionar y/o eliminar uno o varios productos en un mismo reporte.</p>

                                    <div class="visible-sm">
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-center hidden-xs hidden-sm">
                                <div class="phone">
                                    <div class="control">
                                        <button></button>
                                    </div>

                                    <img src="{{ asset('clients/img/phone.svg') }}" alt="iPhone 5" class="iphone"/>

                                    <div class="carousel" data-count="4" data-current="1">
                                        <div class="items">
                                            <div class="item center" data-marker="1">
                                                <img src="{{ asset('clients/img/app-login.jpg') }}" alt="App-Preview"/>
                                            </div>

                                            <div class="item" data-marker="2">
                                                <img src="{{ asset('clients/img/app-signup.jpg') }}" alt="App-Preview" />
                                            </div>

                                            <div class="item" data-marker="3">
                                                <img src="{{ asset('clients/img/app-overview.jpg') }}" alt="App-Preview" />
                                            </div>

                                            <div class="item" data-marker="4">
                                                <img src="{{ asset('clients/img/app-profile.jpg') }}" alt="App-Preview" />
                                            </div>

                                            <!-- <div class="item" data-marker="5">
                                                <img src="{{ asset('clients/img/app-settings.jpg') }}" alt="App-Preview" />
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-center align-center-mobile">
                                <div class="text">
                                    <h1 class="h4"><i class="icon icon-drive hidden-xs"></i> 3. Descripción e Imagen </h1>
                                    <p>Este punto es <strong>opcional</strong>. Puede subir una imagen del producto o su ubicación, o cualquier aclaración que se desee hacer (precio, cantidades, tamaño de la cola, lista de productos, etc).</p>

                                    <div class="hidden-xs">
                                        <br><br>
                                    </div>

                                    <h1 class="h4"><i class="icon icon-share hidden-xs"></i> 4. Ubicación </h1>
                                    <p><strong>Mi ubicación</strong> coge por la geolocalización el lugar donde me encuentro y <strong>Encontrar ubicación</strong> nos da el mapa para ubicar el lugar donde se quiere reportar.</p>
                                </div>
                            </div>
                        </div>
                    </div>
    			</div>
    		</div>
    	</div>

        <div class="screen" data-marker="4">
            <div class="background"></div>

            <div class="content-outside">
    			<div class="content-inside">
    				<div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 align-center align-center-mobile">
                                <div class="text">
                                    <h1 class="h4"> <i class="icon icon-subscribe hidden-xs"></i> 1. Buscar productos </h1>
                                    <p>Para buscar productos seleccionamos el ícono de <strong>Buscar</strong>. (Clikeando el botón del celular de la imagen puede ver los pasos visualmente.)</p>

                                    <div class="hidden-xs">
                                        <br><br>
                                    </div>

                                    <h1 class="h4"><i class="icon icon-rent hidden-xs"></i> 2. Selección de productos </h1>
                                    <p>Seleccionamos los productos que se desean buscar su ubicación. Los productos tienen integrado búsquedas para encontar más fácil, podrá eliminar o sumar productos según desee.</p>

                                    <div class="visible-sm">
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-center hidden-xs hidden-sm">
                                <div class="phone">
                                    <div class="control">
                                        <button></button>
                                    </div>

                                    <img src="{{ asset('clients/img/phone.svg') }}" alt="iPhone 5" class="iphone"/>

                                    <div class="carousel" data-count="4" data-current="1">
                                        <div class="items">
                                            <div class="item center" data-marker="1">
                                                <img src="{{ asset('clients/img/app-loginfound.jpg') }}" alt="App-Preview"/>
                                            </div>

                                            <div class="item" data-marker="2">
                                                <img src="{{ asset('clients/img/app-overview.jpg') }}" alt="App-Preview" />
                                            </div>

                                            <div class="item" data-marker="3">
                                                <img src="{{ asset('clients/img/app-overviewfound.jpg') }}" alt="App-Preview" />
                                            </div>

                                            <div class="item" data-marker="4">
                                                <img src="{{ asset('clients/img/app-profilefound.jpg') }}" alt="App-Preview" />
                                            </div>

                                            <!-- <div class="item" data-marker="5">
                                                <img src="{{ asset('clients/img/app-settings.jpg') }}" alt="App-Preview" />
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-center align-center-mobile">
                                <div class="text">
                                    <h1 class="h4"><i class="icon icon-drive hidden-xs"></i> 3. Encontrados </h1>
                                    <p>Aparecen en el mapa todos los reportes de las últimas 24 horas de los productos seleccionados.</p>

                                    <div class="hidden-xs">
                                        <br><br>
                                    </div>

                                    <h1 class="h4"><i class="icon icon-share hidden-xs"></i> 4. Formato de Pines </h1>
                                    <p>Los pines que aparecen en general aparecen en <strong>rojo</strong>. Los pines que se guardan en favorito se muestran en <strong>azul</strong> y el pin que se encuentra seleccionado en el momento se muestra en <strong>verde</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
    			</div>
    		</div>
        </div>

        <div class="screen" data-marker="5">
            <div class="background"></div>

            <div class="content-outside">
                <div class="content-inside align-center">
                    <div class="qr-code hidden-xs hidden-sm">
                        <img src="{{ asset('clients/img/qr-code.jpg') }}" alt="business-start"/>
                    </div>

                    <div class="text">
                        <h1>¡Descarga gratis!</h1>
                        <p class="hidden-xs hidden-sm">Escanea el código QR para descargar</p>
                        <a href="{{ route('update.app') }}" type="button" class="btn btn-default btn-lg btn3d"><img src="{{ asset('clients/img/icono.png') }}" alt="logo" title="logo" width="30px" heigth='30px'></img> Descargar</a>
                        <!-- <p class="hidden-md hidden-lg">Descarga App Gratis!!! <br> </p> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="screen" data-marker="6">
            <div class="background"></div>

            <div class="content-outside">
                <div class="content-inside align-center">
                    <div class="text">
                        <h1 class="h2">Nuestro Equipo</h1>
                        <br>
                    </div>

                    <div class="team">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-4 col">
                                    <div class="photo">
                                        <img style="-ms-transform: scale(1.2, 1.2); -webkit-transform: scale(1.2, 1.2); transform: scale(1.2);" src="https://scontent-mad1-1.xx.fbcdn.net/v/t1.0-9/94874082_1643464185806933_508059588478631936_n.jpg?_nc_cat=108&_nc_sid=09cbfe&_nc_ohc=fQvyLxMSD4sAX9doh1S&_nc_ht=scontent-mad1-1.xx&oh=62c98a2f5043354fd2d4debbf17ac279&oe=5EF6987B" alt="A. Herrera" title="A. Herrera"/>

                                        <div class="overlay"></div>
                                        <div class="about">
                                            <div class="content-outside">
                                                <div class="content-inside">
                                                    <h2 class="h5"> A. Herrera </h2>
                                                    <p> &middot; CEO &middot; Co-Founder</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-4 col">
                                    <div class="photo">
                                        <img src="{{ asset('clients/img/ian.jpg') }}" alt="Ian Funestes" title="Ian Funestes"/>

                                        <div class="overlay"></div>
                                        <div class="about">
                                            <div class="content-outside">
                                                <div class="content-inside">
                                                    <h2 class="h5"> Ian Funestes </h2>
                                                    <p> &middot; CEO &middot; Co-Founder &middot;</p>
                                                    <!-- <p> &middot; Manager &middot; </p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-4 col">
                                    <div class="photo">
                                        <img src="{{ asset('clients/img/javi.jpg') }}" alt="Javier A. Rodríguez" title="Javier A. Rodríguez"/>

                                        <div class="overlay"></div>
                                        <div class="about">
                                            <div class="content-outside">
                                                <div class="content-inside">
                                                    <h2 class="h5"> Javier A. Rodríguez </h2>
                                                    <p> &middot; Manager &middot; </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-xs-6 col-sm-6 col-md-3 col">
                                    <div class="photo">
                                        <img src="{{ asset('clients/img/team-4.jpg') }}" alt="Andrew Hart" title="Andrew Hart"/>

                                        <div class="overlay"></div>
                                        <div class="about">
                                            <div class="content-outside">
                                                <div class="content-inside">
                                                    <h2 class="h5"> Andrew Hart </h2>
                                                    <p> &middot; Developer &middot; </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="screen" data-marker="7">
            <div class="background"></div>

            <div class="content-outside">
                <div class="content-inside align-center">
                    <div class="text">
                        <h1>Contáctanos</h1>
                        <br>
                        <a href="https://api.whatsapp.com/send?phone=+34634148324"> +34 634 148 324</a>
                        <br>
                        <a href="https://api.whatsapp.com/send?phone=+34644930905"> +34 644 930 905</a>
                        <br>
                        <a href="https://api.whatsapp.com/send?phone=5353848066"> +53 538 480 66</a>

                        <br><br>
                        <div class="social">
                            <a href="https://www.facebook.com/tEncontreCuba" class="facebook"><i class="fa fa-facebook-official"></i></a>
                            <!-- <a href="#skype" class="skype"><i class="fa fa-skype"></i></a>
                            <a href="#twitter" class="twitter"><i class="fa fa-twitter"></i></a> -->
                        </div>
                        <br><br>

                        <p class="footnote"> Desarrollado por <a href="https://codeals.es/"> Codeals </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="{{ asset('clients/js/bootstrap.min.js') }}"></script>

    <!-- Custom CSS Core -->
    <script type="text/javascript" src="{{ asset('clients/js/core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('clients/js/jquery.mousewheel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('clients/js/device.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('clients/js/jquery.touchSwipe.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('clients/js/carousel.js') }}"></script>


    <!-- <script type="text/javascript" src="js/constellation/stopExecutionOnTimeout.js"></script>
    <script type="text/javascript" src="js/constellation/zepto.min.js"></script>
    <script type="text/javascript" src="js/constellation/constellation.js"></script> -->
  </body>
</html>

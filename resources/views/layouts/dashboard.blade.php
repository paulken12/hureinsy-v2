<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-on="http://www.w3.org/1999/xhtml"
      xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RAJ Technologies, Inc') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <style>
        #loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                opacity: 0
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0
            }
        }</style>

    <!-- Styles -->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    @include('layouts.loader')

    <div id="app">
        <div class="app" v-bind:class="{ 'is-collapsed' : isClose }">>

            @include('layouts.sidebar')

            <div class="page-container" >
                <div class="header navbar">
                    <div class="header-container">
                        <ul class="nav-left">
                            <li><a v-on:click="isClose = !isClose"><i
                                            class="ti-menu"></i></a>
                            </li>
                            <li class="search-box"><a class="search-toggle no-pdd-right" href="javascript:void(0);"><i
                                            class="search-icon ti-search pdd-right-10"></i> <i
                                            class="search-icon-close ti-close pdd-right-10"></i></a></li>
                            <li class="search-input"><input class="form-control" type="text" placeholder="Search..."></li>
                        </ul>
                        <ul class="nav-right">
                            <li class="notifications dropdown"><span class="counter ">3</span> <a href=""
                                                                                                  class="dropdown-toggle no-after"
                                                                                                  data-toggle="dropdown"><i
                                            class="ti-bell"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="pX-20 pY-15 bdB"><i class="ti-bell pR-10"></i> <span
                                                class="fsz-sm fw-600 c-grey-900">Notifications</span></li>
                                    <li>
                                        <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                                            <li><a href=""
                                                   class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15"><img class="w-3r bdrs-50p"
                                                                                 src="{{asset('images/avatars/raj_male.png')}}"
                                                                                 alt=""></div>
                                                    <div class="peer peer-greed"><span><span
                                                                    class="fw-500">John Doe</span> <span class="c-grey-600">approved <span
                                                                        class="text-dark">Job Offer</span></span></span>
                                                        <p class="m-0">
                                                            <small class="fsz-xs">5 mins ago</small>
                                                        </p>
                                                    </div>
                                                </a></li>
                                            <li><a href=""
                                                   class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15"><img class="w-3r bdrs-50p"
                                                                                 src="{{asset('images/avatars/raj_male.png')}}"
                                                                                 alt=""></div>
                                                    <div class="peer peer-greed"><span><span
                                                                    class="fw-500">Moo Doe</span> <span
                                                                    class="c-grey-600">disapproved <span class="text-dark">PAF</span></span></span>
                                                        <p class="m-0">
                                                            <small class="fsz-xs">7 mins ago</small>
                                                        </p>
                                                    </div>
                                                </a></li>
                                            <li><a href=""
                                                   class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15"><img class="w-3r bdrs-50p"
                                                                                 src="{{asset('images/avatars/raj_male.png')}}"
                                                                                 alt=""></div>
                                                    <div class="peer peer-greed"><span><span
                                                                    class="fw-500">Lee Doe</span> <span
                                                                    class="c-grey-600">approved <span
                                                                        class="text-dark">PAF</span></span></span>
                                                        <p class="m-0">
                                                            <small class="fsz-xs">10 mins ago</small>
                                                        </p>
                                                    </div>
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li class="pX-20 pY-15 ta-c bdT"><span><a href=""
                                                                              class="c-grey-600 cH-blue fsz-sm td-n">View All Notifications <i
                                                        class="ti-angle-right fsz-xs mL-10"></i></a></span></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1"
                                                    data-toggle="dropdown">
                                    <div class="peer mR-10"><img class="w-2r bdrs-50p"
                                                                 src="{{asset('images/avatars/raj_male.png')}}"
                                                                 alt="">
                                    </div>
                                    <div class="peer"><span class="fsz-sm c-grey-900">John Doe</span></div>
                                </a>
                                <ul class="dropdown-menu fsz-sm">
                                    <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                                    class="ti-settings mR-10"></i> <span>Setting</span></a></li>
                                    <li><a href="{{route('profile')}}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                                    class="ti-user mR-10"></i>
                                            <span>Profile</span></a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                                    class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <main class="main-content bgc-grey-100">
                    <div id="mainContent">

                        @yield('content')

                    </div>
                </main>
                <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span><a
                                href="#" target="_blank" title="RAJ Technologies, Inc.">RAJ Technologies, Inc.</a> Copyright © 2018</span>
                </footer>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{asset('js/app.js')}}" defer></script>

</body>
</html>

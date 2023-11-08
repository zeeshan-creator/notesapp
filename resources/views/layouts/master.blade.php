<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        @yield('title') | Notes App
    </title>
    <meta name="description" content="Page Titile">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/vendors.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/app.bundle.css') }}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/formplugins/select2/select2.bundle.css') }}">

    <!--<link rel="stylesheet" media="screen, print" href="css/your_styles.css">-->
</head>

<body class="mod-bg-1 ">
    <!-- DOC: script to save and load page settings -->
    <script>
        /**
         *	This script should be placed right after the body tag for fast execution
         *	Note: the script is written in pure javascript and does not depend on thirdparty library
         **/
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /**
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';
        /**
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);
        }
        /**
         * Save to localstorage
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /**
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar">
                <div class="page-logo">
                    <a href="#"
                        class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                        data-toggle="modal" data-target="#modal-shortcut">
                        <img src="{{ asset('img/logo.png') }}" alt="Notes App" aria-roledescription="logo">
                        <span class="page-logo-text mr-1">Notes App</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                        <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <nav id="js-primary-nav" class="primary-nav" role="navigation">
                    <div class="nav-filter">
                        <div class="position-relative">
                            <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control"
                                tabindex="0">
                            <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                                data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                <i class="fal fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="info-card">
                        <img src="{{ asset('img/demo/avatars/avatar-admin.png') }}" class="profile-image rounded-circle"
                            alt="{{ Auth::user()->name }}">
                        <div class="info-card-text">
                            <a href="#" class="d-flex align-items-center text-white">
                                <span class="text-truncate text-truncate-sm d-inline-block">
                                    {{ Auth::user()->name }}
                                </span>
                            </a>
                            <span
                                class="d-inline-block text-truncate text-truncate-sm">{{ Auth::user()->email }}</span>
                        </div>
                        <img src="{{ asset('img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
                        <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                            data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                            <i class="fal fa-angle-down"></i>
                        </a>
                    </div>
                    <ul id="js-nav-menu" class="nav-menu">
                        <li class="active">
                            <a href="#" title="Notes">
                                <i class="fal fa-cog"></i>
                                <span class="nav-link-text">Notes</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route('notes.index') }}" title="All Notes">
                                        <span class="nav-link-text">
                                            All Notes
                                        </span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('shared.notes.index') }}" title="Shared Notes">
                                        <span class="nav-link-text">
                                            Shared Notes
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="filter-message js-filter-message bg-success-600"></div>
                </nav>
                <!-- END PRIMARY NAVIGATION -->
                <!-- NAV FOOTER -->
                <div class="nav-footer shadow-top">
                    <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
                        class="hidden-md-down">
                        <i class="ni ni-chevron-right"></i>
                        <i class="ni ni-chevron-right"></i>
                    </a>
                    <ul class="list-table m-auto nav-footer-buttons">
                        <li>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                                title="Chat logs">
                                <i class="fal fa-comments"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                                title="Support Chat">
                                <i class="fal fa-life-ring"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                                title="Make a call">
                                <i class="fal fa-phone"></i>
                            </a>
                        </li>
                    </ul>
                </div> <!-- END NAV FOOTER -->
            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->
                    <div class="page-logo">
                        <a href="#"
                            class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                            data-toggle="modal" data-target="#modal-shortcut">
                            <img src="{{ asset('img/logo.png') }}" alt="Notes App" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">Notes App</span>
                            <span
                                class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a href="#" class="header-btn btn js-waves-off" data-action="toggle"
                            data-class="nav-function-hidden" title="Hide Navigation">
                            <i class="ni ni-menu"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle"
                                    data-class="nav-function-minify" title="Minify Navigation">
                                    <i class="ni ni-minify-nav"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle"
                                    data-class="nav-function-fixed" title="Lock Navigation">
                                    <i class="ni ni-lock-nav"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- DOC: mobile button appears during mobile width -->
                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle"
                            data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>
                    <div class="search">
                        <form class="app-forms hidden-xs-down" role="search" action="page_search.html"
                            autocomplete="off">
                            <input type="text" id="search-field" placeholder="Search for anything"
                                class="form-control" tabindex="1">
                            <a href="#" onclick="return false;"
                                class="btn-danger btn-search-close js-waves-off d-none" data-action="toggle"
                                data-class="mobile-search-on">
                                <i class="fal fa-times"></i>
                            </a>
                        </form>
                    </div>
                    <div class="ml-auto d-flex">
                        <!-- app user menu -->
                        <div>
                            <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                                class="header-icon d-flex align-items-center justify-content-center ml-2">
                                <img src="{{ asset('img/demo/avatars/avatar-admin.png') }}"
                                    class="profile-image rounded-circle" alt="{{ Auth::user()->name }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                        <span class="mr-2">
                                            <img src="{{ asset('img/demo/avatars/avatar-admin.png') }}"
                                                class="rounded-circle profile-image" alt="{{ Auth::user()->name }}">
                                        </span>
                                        <div class="info-card-text">
                                            <div class="fs-lg text-truncate text-truncate-lg">{{ Auth::user()->name }}
                                            </div>
                                            <span
                                                class="text-truncate text-truncate-md opacity-80">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <a href="#" class="dropdown-item" data-action="app-reset">
                                    <span data-i18n="drpdwn.reset_layout">Reset Layout</span>
                                </a>
                                <a href="#" class="dropdown-item" data-toggle="modal"
                                    data-target=".js-modal-settings">
                                    <span data-i18n="drpdwn.settings">Settings</span>
                                </a>
                                <div class="dropdown-divider m-0"></div>
                                <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                    <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                    <i class="float-right text-muted fw-n">F11</i>
                                </a>
                                <a href="#" class="dropdown-item" data-action="app-print">
                                    <span data-i18n="drpdwn.print">Print</span>
                                    <i class="float-right text-muted fw-n">Ctrl + P</i>
                                </a>
                                <div class="dropdown-multilevel dropdown-multilevel-left">
                                    <div class="dropdown-item">
                                        Language
                                    </div>
                                    <div class="dropdown-menu">
                                        <a href="#?lang=fr" class="dropdown-item" data-action="lang"
                                            data-lang="fr">Français</a>
                                        <a href="#?lang=en" class="dropdown-item active" data-action="lang"
                                            data-lang="en">English (US)</a>
                                        <a href="#?lang=es" class="dropdown-item" data-action="lang"
                                            data-lang="es">Español</a>
                                        <a href="#?lang=ru" class="dropdown-item" data-action="lang"
                                            data-lang="ru">Русский язык</a>
                                        <a href="#?lang=jp" class="dropdown-item" data-action="lang"
                                            data-lang="jp">日本語</a>
                                        <a href="#?lang=ch" class="dropdown-item" data-action="lang"
                                            data-lang="ch">中文</a>
                                    </div>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item fw-500 pt-3 pb-3" href="page_login.html">
                                    <span data-i18n="drpdwn.page-logout">Logout</span>
                                    <span class="float-right fw-n">&commat;codexlantern</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- END Page Header -->
                <!-- BEGIN Page Content -->
                <!-- the #js-page-content id is needed for some plugins to initialize -->
                <main id="js-page-content" role="main" class="page-content">
                    @yield('content')
                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                <!-- END Page Content -->


                <!-- BEGIN Color profile -->
                <!-- this area is hidden and will not be seen on screens or screen readers -->
                <!-- we use this only for CSS color refernce for JS stuff -->
                <p id="js-color-profile" class="d-none">
                    <span class="color-primary-50"></span>
                    <span class="color-primary-100"></span>
                    <span class="color-primary-200"></span>
                    <span class="color-primary-300"></span>
                    <span class="color-primary-400"></span>
                    <span class="color-primary-500"></span>
                    <span class="color-primary-600"></span>
                    <span class="color-primary-700"></span>
                    <span class="color-primary-800"></span>
                    <span class="color-primary-900"></span>
                    <span class="color-info-50"></span>
                    <span class="color-info-100"></span>
                    <span class="color-info-200"></span>
                    <span class="color-info-300"></span>
                    <span class="color-info-400"></span>
                    <span class="color-info-500"></span>
                    <span class="color-info-600"></span>
                    <span class="color-info-700"></span>
                    <span class="color-info-800"></span>
                    <span class="color-info-900"></span>
                    <span class="color-danger-50"></span>
                    <span class="color-danger-100"></span>
                    <span class="color-danger-200"></span>
                    <span class="color-danger-300"></span>
                    <span class="color-danger-400"></span>
                    <span class="color-danger-500"></span>
                    <span class="color-danger-600"></span>
                    <span class="color-danger-700"></span>
                    <span class="color-danger-800"></span>
                    <span class="color-danger-900"></span>
                    <span class="color-warning-50"></span>
                    <span class="color-warning-100"></span>
                    <span class="color-warning-200"></span>
                    <span class="color-warning-300"></span>
                    <span class="color-warning-400"></span>
                    <span class="color-warning-500"></span>
                    <span class="color-warning-600"></span>
                    <span class="color-warning-700"></span>
                    <span class="color-warning-800"></span>
                    <span class="color-warning-900"></span>
                    <span class="color-success-50"></span>
                    <span class="color-success-100"></span>
                    <span class="color-success-200"></span>
                    <span class="color-success-300"></span>
                    <span class="color-success-400"></span>
                    <span class="color-success-500"></span>
                    <span class="color-success-600"></span>
                    <span class="color-success-700"></span>
                    <span class="color-success-800"></span>
                    <span class="color-success-900"></span>
                    <span class="color-fusion-50"></span>
                    <span class="color-fusion-100"></span>
                    <span class="color-fusion-200"></span>
                    <span class="color-fusion-300"></span>
                    <span class="color-fusion-400"></span>
                    <span class="color-fusion-500"></span>
                    <span class="color-fusion-600"></span>
                    <span class="color-fusion-700"></span>
                    <span class="color-fusion-800"></span>
                    <span class="color-fusion-900"></span>
                </p>
                <!-- END Color profile -->
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->
    <!-- BEGIN Quick Menu -->


    <!-- base vendor bundle:
   DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
      + pace.js (recommended)
      + jquery.js (core)
      + jquery-ui-cust.js (core)
      + popper.js (core)
      + bootstrap.js (core)
      + slimscroll.js (extension)
      + app.navigation.js (core)
      + ba-throttle-debounce.js (core)
      + waves.js (extension)
      + smartpanels.js (extension)
      + src/../jquery-snippets.js (core) -->
    <script src="{{ asset('js/vendors.bundle.js') }}"></script>
    <script src="{{ asset('js/app.bundle.js') }}"></script>
    <script src="{{ asset('js/datagrid/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/formplugins/select2/select2.bundle.js') }}"></script>


    @yield('scripts')

</body>

</html>

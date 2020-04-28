<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PABI</title>

    @include('Ods\Core::partials.css')
    @yield('addcss')
    @include('Ods\Core::partials.js')
</head>

<body class="navbar-bottom pace-done sidebar-opposite-visible" style="">
    @yield('two_sidebar')
    @yield('need_sidebar')
    @include('Ods\Core::partials.navbar')


    <div class="page-container" style="min-height:732.7666625976562px">


        <div class="page-content">
            @empty($need_sidebar)
                @include('Ods\Core::partials.sidebar')
            @endempty

            <div class="content-wrapper">
                @empty($need_sidebar)
                    @include('Ods\Core::partials.header')
                @endempty

                @yield('content')

            </div>

            @yield('sidebar-right')
        </div>
    </div>

    @include('Ods\Core::partials.footer')
    @include('Ods\Core::partials.swal')
    @yield('addjs')

</body>

</html>

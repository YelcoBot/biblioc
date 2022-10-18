<!DOCTYPE html>
<html lang="es-co">

<head>
    @include('layout.partials.head')
</head>

<body class="animsition">

    <div class="page-wrapper">
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER -->
            @include('layout.partials.header')
            <!-- HEADER -->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('content')
                        @include('layout.partials.footer')
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    @include('layout.partials.footer-scripts')

</body>

</html>
<!-- end document-->

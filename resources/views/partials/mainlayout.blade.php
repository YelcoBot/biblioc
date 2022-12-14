<!DOCTYPE html>
<html lang="es-co">

<head>
    @include('partials.head')
</head>

<body class="animsition">

    <div class="page-wrapper">
        <!-- HEADER -->
        @include('partials.header')
        <!-- HEADER -->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER -->
            @include('partials.nav')
            <!-- HEADER -->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('content')
                        @include('partials.footer')
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

            <!-- MODAL -->
            @include('partials.modal')
            <!-- MODAL -->
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    @include('partials.footer-scripts')

</body>

</html>
<!-- end document-->

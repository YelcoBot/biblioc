<!DOCTYPE html>
<html lang="es-co">

<head>
    @include('partials.head')
</head>

<body class="animsition">

    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{!! asset('images/icon/logo.png') !!}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Usuario</label>
                                    <input class="au-input au-input--full" type="text" name="username"
                                        placeholder="Usuario">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" type="email" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Contrase&ntilde;a</label>
                                    <input class="au-input au-input--full" type="password" name="password"
                                        placeholder="Contrase&ntilde;a">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="aggree">Acepta los términos y políticas
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20"
                                    type="submit">Registrarme</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Ya tiene una cuenta?
                                    <a href="#">Ingresa aquí</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('partials.footer-scripts')

</body>

</html>
<!-- end document-->

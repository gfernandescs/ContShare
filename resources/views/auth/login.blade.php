<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>ContShare</title>
        <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
        <link rel="stylesheet" href="css/auth/style.css">
    </head>

    <body>
        <div class="pen-title">
            <h1>ContShare</h1><span>Salve, Compartilhe e Descubra</a></span>    
        </div>
        <!-- Form Module-->
        <div class="module form-module">
            <div class="toggle">
                <i class="fa fa-times fa-pencil"></i>
                <div id="tooltip" class="tooltip no-tooltip">
                    Criar Conta
                </div>
            </div>      
            <div class="form">              
                <h2>Entrar</h2>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-6">
                                <input id="email" type="email" required class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-6">
                                <input id="password" type="password" required class="form-control" placeholder="Senha" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                
                            </div>
                        </div>
                    </form>
            </div>
            <div class="form">
                <h2>Criar uma conta</h2>
                <form action="#" method="POST">
                    <input type="text" required name="name" placeholder="Nome"/>
                    <input type="text" required name="last_name" placeholder="Sobrenome"/>
                    <input type="password" required name="password" placeholder="Senha"/>
                    <input type="email" required name="email" placeholder="Email"/>

                    <input type="submit" name="cadastrar" value="Registrar" class="btn">
                </form>
            </div>
            <div id="cta" class="cta no-cta">
                <a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueceu sua senha?</a>
            </div>
        </div>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="js/auth/index.js"></script>
    </body>
</html>
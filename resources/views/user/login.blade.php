<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
        <title>User Login</title>
        <script src="{{asset('jquery/jquery-3.6.1.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- Bootstrap CSS -->
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}" rel="stylesheet">
        <style>
            body {
                min-width: 900px;
            }
            main {
                margin-top : 12%;
                border: 1px solid gray;
                border-radius : 8px;
                margin-left : 15%;
                margin-right : 15%;
                padding-top : 10%;
                padding-bottom : 10%;
                padding-left : 15%;
                padding-right : 15%;
                background-color : #f8f9fa;
            }
            a {
                text-decoration : underline !important;
            }
        </style>
    </head>
    <body>
        <main>
        <div style="text-align:left;margin-bottom:25px">
            <h2>Log in</h2>
        </div>
        <!-- <form action="login" method="POST">
            @csrf
            <div class="form-group">
                    <div>
                        <label for="username"><span>Username : </span></label>
                    </div>
                    <div>
                        <input type="text" name="username"><br/>
                    </div>
                </div>
                <p class="error">
                    {{ $errors->first('username') }}
                </p>
                <div class="form-group">
                    <div>
                        <label for="password"><span>Password : </span></label>
                    </div>
                    <div>
                        <input type="password" name="password"><br/>
                    </div>
                </div>
                <p class="error">
                    {{ $errors->first('password') }}
                </p>
            <div>
                <input type="submit" value="Login" />
                <p>Forgot your password? Reset here</p>
                <p>Don't have an account? Register <a href="/user/register" >here </a><p>
                <p> <a href="/">Go back to Home page </a></p>
            </div>
        </form> -->


        <form action="login" method="POST">
            @csrf
            <p class="error">
                {{ $errors->first('msg') }}
            </p>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
            </div>
            <p class="error">
                {{ $errors->first('username') }}
            </p>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <p class="error">
                {{ $errors->first('password') }}
            </p>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p>Forgot your password? Reset here</p>
        <p>Don't have an account? Register <a href="/user/register" >here </a><p>
        <p> <a href="/">Go back to Home page </a></p>

        </main>

    </body>
</html>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
        <title>User Register</title>
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
                /* text-align : center; */
                margin-top : 9%;
                border: 1px solid gray;
                border-radius : 4px;
                margin-left : 15%;
                margin-right : 15%;
                padding-top : 10%;
                padding-bottom : 10%;
                padding-left : 15%;
                padding-right : 15%;
            }
            a {
                text-decoration : underline !important;
            }
        </style>
    </head>
    <body>
        <main>
        <div style="text-align:left;margin-bottom:25px">
            <h2>Registration form</h2>
        </div>
        <div>
            @if (Session::has('msg'))
                <div class="alert alert-info">{{ Session::get('msg') }}</div>
            @endif
        </div>
        <div class="error">
            @if($errors->any())
            <h4>{{$errors->first()}}</h4>
            @endif
        </div>
        <div class="stretch">
            <!-- <form action="register" method="POST">
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
                        <label for="email"><span>Email : </span></label>
                    </div>
                    <div>
                        <input type="email" name="email"><br/>
                    </div>
                </div>
                <p class="error">
                    {{ $errors->first('email') }}
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
                <div class="form-group">
                    <div>
                        <label for="password_confirmation"><span>Reinput Password : </span></label>
                    </div>
                    <div>
                        <input type="password" name="password_confirmation"><br/>
                    </div>
                </div>
                <p class="error">
                    {{ $errors->first('password_confirmation') }}
                </p>
                <div>
                    <input type="submit" value="Register" />
                    <p>Already have an account? Log in <a href="/user/login" > here </a><p>
                    <p> <a href="/">Go back to Home page </a></p>
                </div>
            </form> -->
            <form action="register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
                </div>
                <p class="error">
                    {{ $errors->first('username') }}
                </p>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                </div>
                <p class="error">
                    {{ $errors->first('email') }}
                </p>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <p class="error">
                    {{ $errors->first('password') }}
                </p>
                <div class="form-group">
                    <label for="password_confirmation">Reinput Password : </label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Reinput Password">
                </div>
                <p class="error">
                    {{ $errors->first('password_confirmation') }}
                </p>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <p>Already have an account? Log in <a href="/user/login" > here </a><p>
            <p> <a href="/">Go back to Home page </a></p>
        </div>

        

        </main>

    </body>
</html>




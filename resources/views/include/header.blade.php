<style>
    .header {
        display : flex;
        width : 100%;
        color : #fffff;
        background-color : #4254f5;
        border-radius : 6px 6px 0px 0px;
        min-height : 180px;
    }
    .banner {
        color : #ffffff;
        align-items: center;
        justify-content: space-evenly;
        display : flex;
        font-size : 20px;
        text-decoration : bold;
    }
    .header div {
        flex : 1
    }
    .nav-bar>div {
        display : inline-block;
        margin : 6px;
        padding : 6px;
        border-radius : 4px;
        border : none;
        background-color : #2466d6;
        color : #ffffff !important;
        font-weight : 700;

    }
    .nav-bar {
        text-align : right;
        font-size : 16px;
    }
    .mid-section {
        flex : 1;
    }
    
    a:link, a:active, a:visited {
        color : inherit;
        text-decoration: none;
    }
    .welcome-msg {
        font-weight : 700;
        color :#fff;
    }
</style>

    <script src="{{asset('jquery/jquery-3.6.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}" rel="stylesheet">
    
<header class="header">
    <div class="banner">
        Venue Booking System
    </div>
    <div class="mid-section">

    </div>
    <div class="nav-bar">
        @if( auth()->check() )
            <span class="welcome-msg">
                Welcome, {{ auth()->user()->username }} 
            </span>
            <div>
                @if(auth()->user()->priviledge == 2) 
                    <a href="/admin/settings">Settings</a>
                @endif
            </div>
            <div>
                @if(auth()->user()->priviledge == 1 or auth()->user()->priviledge == 2) 
                    <a href="/admin/dashboard">Dashboard</a>
                @endif
            </div>
            <div>
                <a href="/user/book"><b>Book a venue</b></a>
            </div>
            <div>
                <a href="/user/bookhistory"><b>View booking history</b></a>
            </div>
            <div>
                <a href="/user/logout"><b>Log Out</b></a>
            </div>
        @else 
            <div>
                <a href="/user/login"><b>Login</b></a>
            </div>
            <div>
                <a href="/user/register"><b>Register</b></a>
            </div>
        @endif

    </div>
</header>
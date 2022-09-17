
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Venue Booking System</title>
        <style>
            body {
                min-width: 1200px;
                font-size : 16px;
                font-family : Montserrat,-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif
            }
            section {
                padding : 15px 25%;
                min-height : 80px;

            }
            .features>ul>li {

            }
            .why {
                display:flex;
            }
            .why>div {
                flex : 1;
                border-radius : 4px;
                box-shadow: 5px 10px #888888;
                background-image: linear-gradient(to bottom left,#ffffff, #42b6f5);
                min-height : 300px;
                margin : 15px;
                font-size : 18px;
                align-items: center;
                justify-content: center;
                display : flex;
                padding : 0px 18px;
                font-weight : 700;
            }
            .icon {
                width : 58px;
                height : 58px;
                margin : 6px;
            }
        </style>
    </head>
    <body>
        @include('include/header')
        <main>
            <section>
                <p><h2>What is available now?</h2></p>
            </section>
            <section>
                <table>

                </table>
            </section>
            <section class="features">
                <h2>What can you book using venue booking system?</h2>
                <ul>
                    <li>Dewan</li>
                    <li>Padang Bola</li>
                    <li>Badminton Court</li>
                </ul>
            </section>
            <section>
                <p><h2>Why book online?</h2></p>
            </section>
            <section class="why">
                
                <div>
                    <p><img src="{{ URL::asset('img/calendar.png') }}" class="icon" /></p>
                    Through our website you can check the latest price and availability of venues.
                </div>
                <div>
                    <p><img src="{{ URL::asset('img/cc2.png') }}" class="icon" /></p>
                    Book online without having to physically visit our facilities.
                </div>
                <div>
                    <p><img src="{{ URL::asset('img/sports.png') }}" class="icon" /></p>
                    Slowly browse through our facilities and view them from the comfort of your home.
                </div>
            </section>

        </main>

    </body>
</html>
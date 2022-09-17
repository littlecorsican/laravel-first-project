
@extends('layout')
 
 @section('title', 'Book a venue')
  
 <!-- @section('sidebar')
  
     <p>This is appended to the master sidebar.</p>
 @stop -->
  
 @section('content')

    <style>
        main {
            padding : 4%;
        }
        .step1 {
            max-width : 400px;
        }
        .step2 {
           max-width : 400px;
        }
        /* .flex-box {
            display : flex;
            width : 100%;
            padding : 6px;
        }
        .flex-one {
            margin : 3%;
            flex : 1;
            min-height : 300px;
        } */
        .admin-login {
            background-color : #000;
            color : #fff;
            padding : 6px 8px;
        }
    </style>

    
    <main>
        <p><h2><b>Book a venue</b></h2></p>
        @if (Session::has('addBookMsg'))
            <div class="alert alert-info">{{ Session::get('addBookMsg') }}</div>
        @endif
        <p><h3>Step 1 : Select venue</h3></p>
        <form action="book" method="POST">
            @csrf
            <div class="step1">
                <!-- <select id="venue_type_select" class="form-select">
                <option value="">Please Select</option>
                    @for ($i = 0; $i < COUNT($venue_type) ; $i++)
                        <option value="">{{$venue_type[$i]->venue_type_name}}</option>
                    @endfor
                </select> -->
                <select id="venue_select" class="form-select" onChange="venueSelect()" name="venue_select">
                    <option value="">Please Select</option>
                    @for ($i = 0; $i < COUNT($venues) ; $i++)
                        <option value="{{$venues[$i]->venue_id}}">{{ $venues[$i]->venue_type_name }} --  ID : {{ $venues[$i]->court_id }}</option>
                    @endfor
                </select>
            </div>
            <div class="step2">
                <p><h3>Step 2 : Select date and time</h3></p>
                    <p><input type="date" name="date_selector" id="dateSelector" class="form-calendar" /></p>
                    <p>
                        Start : <select id="start_input" class="form-select" name="start_input"></select>
                        End : <select id="end_input"class="form-select" name="end_input"></select>
                    </p>
                    <div class="alert alert-secondary" role="alert" id="restDayAlert">

                    </div>
            </div>
            <div class="step2">
                <h4>Price</h4>
                <p>Per hour :$ <span id="priceperhour"></span></p>
                <!-- <p>Total : $ <span id="pricetotal"></span></p> -->
            </div>
            <input type="submit" value="Book" />
        </form>
    </main>
    <script>

        varRestDaysIntToStr = {
            "1" : "Monday",
            "2" : "Tuesday",
            "3" : "Wednesday",
            "4" : "Thursday",
            "5" : "Friday", 
            "6" : "Saturday",
            "7" : "Sunday"
        }

        $( document ).ready(function() {
            console.log( "ready!" );
            
            $("#restDayAlert").hide()
            let now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            console.log(today)
            document.getElementById("dateSelector").setAttribute("min", today);

            $("#dateSelector").val(now.getFullYear() + "-" + month + "-" + day )

            // $("#start_input").on('change', function() {
            //     calculateTotalPrice()
            // });
            // $("#end_input").on('change', function() {
            //     calculateTotalPrice()
            // });


        });

        function calculateTotalPrice() {

        }

        function venueSelect() {

            $("#restDayAlert").hide()
            var venues = {!! json_encode($venues->toArray()) !!};
            var selectedValue = $('#venue_select').find(":selected").val()
            console.log("selectedValue" + selectedValue)
            console.log(venues)

            var hours = []
            for (let i = 0 ; i < venues.length; i++) {
                console.log(venues[i])
                if (venues[i].venue_id == selectedValue) {
                    for (let o =venues[i].start_hour ; o < venues[i].end_hour; o++) {
                        hours.push(o)
                    }
                    // convert rest days from int to readable form
                    let restDays = venues[i].rest_days.split(",").map((ele)=>{
                        return varRestDaysIntToStr[ele]
                    })
                    console.log(restDays)
                    let restDaysStr = restDays.join(' and ')
                    $("#restDayAlert").html(`We rest on every ${restDaysStr}`)
                    $("#restDayAlert").show()
                    $("#priceperhour").text(venues[i].venue_price)
                    //$("#pricetotal").text(venues[i].venue_price)
                    break;
                }
            }
            console.log(hours)

            //convert 24H format to 12H format and append
            for (let i = 0 ; i < hours.length-1; i++) {
                if (hours[i] == 12) {
                    $('#start_input').append(`<option value="12">12:00PM</option>`);
                } else if (hours[i] > 11) {
                    //hours[i] = (hours[i] - 12 ) + ":00 PM"
                    $('#start_input').append(`<option value="${hours[i]}">${hours[i] - 12 }:00PM</option>`);
                } else {
                    $('#start_input').append(`<option value="${hours[i]}">${hours[i]}:00AM</option>`);
                    //hours[i] += ":00 AM"
                }
            }

            for (let i = 1 ; i < hours.length; i++) {
                if (hours[i] == 12) {
                    $('#end_input').append(`<option value="12">12:00PM</option>`);
                } else if (hours[i] > 11) {
                    //hours[i] = (hours[i] - 12 ) + ":00 PM"
                    $('#end_input').append(`<option value="${hours[i]}">${hours[i] - 12 }:00PM</option>`);
                } else {
                    $('#end_input').append(`<option value="${hours[i]}">${hours[i]}:00AM</option>`);
                    //hours[i] += ":00 AM"
                }
            }

            
        }
    </script>

@stop
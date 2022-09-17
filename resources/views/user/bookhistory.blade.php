
@extends('layout')
 
 @section('title', 'Booking History')
  
 @section('content')

    <style>
        main {
            padding : 4%;
        }
    </style>

    <main>
        <h2>View your booking history</h2>
        <table class="table" >
            <thead class="thead-dark">
                <tr>
                    <th>Booking ID</th>
                    <th>Venue</th>
                    <th>Court ID</th>
                    <th>Booking Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{$booking->id}}</td>
                    <td>{{$booking->venue_type_name}}</td>
                    <td>{{$booking->court_id}}</td>
                    <td>{{$booking->booking_date}}</td>
                    <td>{{$booking->booking_time_start}}</td>
                    <td>{{$booking->booking_time_end}}</td>
                    <td>{{$booking->price}}</td>
                    <td>{{$booking->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </main>
@stop
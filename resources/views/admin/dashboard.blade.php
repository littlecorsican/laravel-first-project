
@extends('layout')
 
 @section('title', 'Admin Dashboard')
  
 @section('content')

    <style>
        main {
            padding : 4%;
        }
    </style>

    <main>
        <h2>View today's booking</h2>
        <table class="table" >
            <thead class="thead-dark">
                <tr>
                    <th>Booking ID</th>
                    <th>Venue</th>
                    <th>Court ID</th>
                    <th>Username</th>
                    <th>Booking Date</th>
                    <th>Start Time (24H)</th>
                    <th>End Time (24H)</th>
                    <th>Price</th>
                    <th>Booking created date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{$booking->id}}</td>
                    <td>{{$booking->venue_type_name}}</td>
                    <td>{{$booking->court_id}}</td>
                    <td>{{$booking->username}}</td>
                    <td>{{$booking->booking_date}}</td>
                    <td>{{$booking->booking_time_start}}</td>
                    <td>{{$booking->booking_time_end}}</td>
                    <td>{{$booking->price}}</td>
                    <td>{{$booking->created_at}}</td>
                    <td>{{$booking->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </main>
@stop
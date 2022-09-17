<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use Input;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\MessageBag;
use App\Models\VenueType;
use App\Models\Venue;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        return view("user.login");
    }

    public function create(Request $request)
    {
        $form = $request->post();
        $venue_select = $form["venue_select"];  // id of venue
        $date_selector = $form["date_selector"];


        if ($venue_select == NULL) {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Please select venue!']);
        }

        if (!isset($form["start_input"])) {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Please select start time!']);
        }
        if (!isset($form["end_input"])) {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Please select end time!']);
        }

        $start_input = $form["start_input"];
        $end_input = $form["end_input"];

        //validation begins
        // check if day falls on rest day
        $venue = Venue::where("id" , '=', $venue_select)->first();

        if ($venue == NULL) {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Error, unable to proceed with booking.']);
        }

        $timestamp = strtotime($date_selector);
        $day = date('w', $timestamp);
        if (in_array($day, explode(",",$venue->rest_days))) {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Booking date falls on rest day']);
        }

        // check if time falls within operating hours
        if ((int)$start_input < (int)$venue->start_hour OR (int)$end_input > (int)$venue->end_hour ) {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Booking hour falls outside of operating hours']);
        }

        if ((int)$start_input > (int)$end_input ) {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Invalid Time']);
        }

        // calculate total price , price per hour X hours
        $totalHours = (int)$end_input - (int)$start_input;
        $totalPrice = $venue->venue_price * $totalHours;

        $result = Booking::create([
            'user_id' => auth()->user()->id,
            'booking_date' => $date_selector,
            'booking_time_start' => $start_input . ":00:00",
            'booking_time_end' => $end_input . ":00:00",
            'price' => $totalPrice,
            'venue_id' => $venue_select,
            'status' => "Created",
        ]);

        if ($result) {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Booking created succesfully, go to view booking history to check your bookings']);
        } else {
            return Redirect::to('/user/book')->with(['addBookMsg' => 'Error creating booking, please contact admin for more info']);
        }

    }


}

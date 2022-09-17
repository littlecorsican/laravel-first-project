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

class AdminController extends Controller
{
    public function index()
    {
        return view("user.login");
    }


    public function dashboard() {

        $user = Auth::user();
        if ($user == NULL) {
            return Redirect::to('/');
        }
        $priviledge = $user->priviledge;

        if ($priviledge == 0) {
            return Redirect::to('/');
        }

        $bookings = VenueType::join('venues','venues.venue_type_id','=','venue_types.id')
        ->join('bookings','bookings.venue_id','=','venues.id')
        ->selectRaw('venues.*')
        ->selectRaw('venue_types.*')
        ->selectRaw('users.*')
        ->selectRaw('bookings.*')
        ->join('users','bookings.user_id','=','users.id')
        ->where("bookings.booking_date" , '=', date("Y-m-d"))->get();

        //dd($bookings);

        return view("admin.dashboard", ["priviledge"=>$priviledge, "bookings"=>$bookings ]);
    }

    public function settings() {

        $user = Auth::user();
        if ($user == NULL) {
            return Redirect::to('/');
        }
        $priviledge = $user->priviledge;


        if ($priviledge != 2) {
            return Redirect::to('/');
        }

        $days = array(
            "1" => "Monday",
            "2" => "Tuesday",
            "3" => "Wednesday",
            "4" => "Thursday",
            "5" => "Friday",
            "6" => "Saturday",
            "7" => "Sunday",
        );

        $venue_type = VenueType::get();
        $venues = Venue::join('venue_types','venues.venue_type_id','=','venue_types.id')->get();

        return view("admin.settings", ["priviledge"=>$priviledge, "venue_type"=>$venue_type, "venues"=>$venues, "days"=>$days ]);
    }
    
    public function searchUser(Request $request) {
        $user_form = $request->post();
        $username = $user_form['username'];
        //return $username;
        $user = User::where("username" , '=', $username)->first();

        if ($user == NULL) {
            return NULL;
        } else {
            return array("username"=>$user->get("username"), "email"=>$user->get("email"), "priviledge"=>$user->get("priviledge"));
        }


    }

    public function setPriviledgeLevel(Request $request) {
        $form = $request->post();
        $username = $form['username'];
        $priviledge = $user_form['priviledge'];

        $result = User::where('username', $username)->update(array('priviledge' => $priviledge));

        return $result;

    }

}

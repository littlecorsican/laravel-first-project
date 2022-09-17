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

class VenueController extends Controller
{
    public function index()
    {
        return view("user.login");
    }

    public function create(Request $request) {
        $form = $request->post();
        $venues = strtolower($form['venues']);
        $venue_price = $form['venue_price'];
        $start_hour = $form['start_hour'];
        $end_hour = $form['end_hour'];
        $court_id = $form['court_id'];

        //verify court id, court id MUST be unique per venue type 
        $result = Venue::where(([
            ['court_id', '=', $court_id],
            ['venue_type_id', '=', $venues]
        ]))->first();

        if ($result != NULL) {
            return Redirect::to('/admin/settings')->with(['addVenueMsg' => 'Court ID already exists for that venue type']);
        }

        if ((int)$end_hour < (int)$start_hour ) {
            return Redirect::to('/admin/settings')->with(['addVenueMsg' => 'Start hours is bigger than end hours']);
        }

        $rest_days = array();
        for ($i = 1 ; $i < 8; $i++) {
            if ($request->boolean("rest_days_" . $i)) {
                array_push($rest_days, $i);
            }
        }
        // convert array to string so it can fit in the database nicely
        $rest_days_str = implode(",",$rest_days);


        // check if null value or not selected
        if (!is_numeric($venue_price)) {
            return Redirect::to('/admin/settings')->with(['addVenueMsg' => 'Invalid price, please input integer or decimal']);
        } 

        // check if selected any venue
        $result = VenueType::get();
        $newArr = array();
        foreach ($result as $item) {
            array_push($newArr, $item->id);
        }
        if (!in_array($venues, $newArr)) {
            return Redirect::to('/admin/settings')->with(['addVenueMsg' => 'Please select a valid venue type']);
        } 

        //create entry
        $result = Venue::create([
            'venue_type_id' => $venues,
            'court_id' => $court_id,
            'venue_price' => $venue_price,
            'start_hour' => $start_hour,
            'end_hour' => $end_hour,
            'rest_days' => $rest_days_str
        ]);


        if ($result) {
            return Redirect::to('/admin/settings')->with(['addVenueMsg' => 'Item succesfully added']);
        } else {
            return Redirect::to('/admin/settings')->with(['addVenueMsg' => 'Error adding new venue type']);
        }

    }

    public function remove(Request $request) {
        $form = $request->post();
        $id = $form['id'];

        $deleted = Venue::where('id', $id)->delete();
        if ($deleted == 1) {
            return Redirect::to('/admin/settings')->with(['addVenueMsg' => 'Item succesfully removed']);
        } else {
            return Redirect::to('/admin/settings')->with(['addVenueMsg' => 'Error removing item']);
        }
    }
}

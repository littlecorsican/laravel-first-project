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

class VenueTypeController extends Controller
{
    public function index()
    {
        return view("user.login");
    }

    public function create(Request $request) {

        $form = $request->post();
        $venue_type_name = strtolower($form['venue_type_name']);
        $result = VenueType::where('venue_type_name', '=', $venue_type_name)->first();

        // validation begins
        if ($venue_type_name == "") {
            return Redirect::to('/admin/settings')->with(['addVenueTypeMsg' => 'Venue type empty!']);
        }

        // check if that entry already exists
        if ($result) {
            return Redirect::to('/admin/settings')->with(['addVenueTypeMsg' => 'Venue type with that name already exist']);
        } 

        //create entry
        $result = VenueType::create([
            'venue_type_name' => $venue_type_name,
        ]);


        if ($result) {
            return Redirect::to('/admin/settings')->with(['addVenueTypeMsg' => 'Item succesfully added']);
        } else {
            return Redirect::to('/admin/settings')->with(['addVenueTypeMsg' => 'Error adding new venue type']);
        }
        
        
    }
    
    public function remove(Request $request) {
        $form = $request->post();
        $id = $form['id'];

        $deleted = VenueType::where('id', $id)->delete();
        if ($deleted == 1) {
            return Redirect::to('/admin/settings')->with(['addVenueTypeMsg' => 'Item succesfully removed']);
        } else {
            return Redirect::to('/admin/settings')->with(['addVenueTypeMsg' => 'Error removing item']);
        }
    }

}

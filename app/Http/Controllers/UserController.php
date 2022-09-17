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

class UserController extends Controller
{
    public function index()
    {
        return view("user.login");
    }

    public function book()
    {

        $venue_type = VenueType::get();
        //$venues = Venue::get();
        $venues = Venue::join('venue_types','venues.venue_type_id','=','venue_types.id')
        ->select('*','venues.id as venue_id')
        ->get();
        
        /* get user priviledge level
            0 = normal user
            1 = limited admin
            2= super admin
        */
        $user = Auth::user();
        if ($user == NULL) {
            return Redirect::to('/');
        }
        $priviledge = $user->priviledge;

        return view("user.book", ["venue_type"=>$venue_type, "priviledge"=>$priviledge, "venues"=>$venues] );
    }

    public function bookhistory() {

        // $bookings = Booking::join('venues','bookings.venue_id','=','venues.id')
        // ->where("bookings.id" , '=', auth()->user()->id)
        // ->paginate(10);

        $bookings = VenueType::join('venues','venues.venue_type_id','=','venue_types.id')
        ->join('bookings','bookings.venue_id','=','venues.id')
        ->where("bookings.user_id" , '=', auth()->user()->id)
        ->paginate(20);

        // dd($bookings);

        return view("user.bookhistory", ["bookings"=>$bookings] );
    }

    public function login(Request $request) {

        // $user_form = $request->post();
        // $username = $user_form['username'];
        // $password = $user_form['password'];
        //dd($username);

        // Creating Rules for Email and Password
        $rules = array(
            'username' => 'required|alphaNum',
            'password' => 'required|alphaNum|min:8'
        );
            // password has to be greater than 3 characters and can only be alphanumeric and);
            // checking all field

        $validator = Validator::make(Input::all() , $rules);
        // if the validator fails, redirect back to the form

        if ($validator->fails()) {
            return Redirect::to('user/login')->withErrors($validator) // send back all errors to the login form
            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            // create our user data for the authentication
            $userdata = array(
                'username' => Input::get('username') ,
                'password' => Input::get('password')
            );
                // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful
                // do whatever you want on success
                return Redirect::to('user/book');
            } else {
                // validation not successful, send back to form
                return Redirect::to('user/login')->withErrors(['msg' => 'Login failed. Wrong password or account doesnt exists']);;
            }
        }
    }

    public function register(Request $request) {
        // $user_form = $request->post();
        // $username = $user_form['username'];
        // $username = $user_form['email'];
        // $password = $user_form['password'];
        // dd($password);

        $this->validate(request(), [
            'username' => 'required|alphaNum|min:3|max:50',
            'email' => 'required|email',
            'password' => 'min:8|alphaNum|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);

        if (User::where('email', '=', Input::get('email'))->count() > 0) {
            return redirect()->to('/user/register')->withErrors(['msg' => 'Account with that email already exists']);
        }

        if (User::where('username', '=', Input::get('username'))->count() > 0) {
            return redirect()->to('/user/register')->withErrors(['msg' => 'Account with that username already exists']);
        }
        
        $user = User::create(request(['username', 'email', 'password', now()]));
        
        //auth()->login($user);
        return Redirect::to('/user/register')->with(['msg' => 'Registration success, now go to login page to log in']);
        //return redirect()->to('/user/register' ,['msg', 'Registration success, now go to login page to log in']);


        
        // $rules = array(
        //     'username' => 'required|alphaNum|min:3|max:50',
        //     'email' => 'required|email',
        //     'password' => 'min:8|alphaNum|required_with:password_confirmation|same:password_confirmation',
        //     'password_confirmation' => 'min:8'
        // );

        // $validator = Validator::make(Input::all() , $rules);
        // // if the validator fails, redirect back to the form

        // if ($validator->fails()) {
        //     return Redirect::to('user/register')->withErrors($validator) // send back all errors to the register form
        //     ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        // } else {
        //     // create our user data for the authentication
        //     $userdata = array(
        //         'username' => Input::get('username') ,
        //         'password' => Input::get('password')
        //     );
        //         // attempt to do the login
        //     if (Auth::attempt($userdata)) {
        //         // validation successful
        //         // do whatever you want on success
        //     } else {
        //         // validation not successful, send back to form
        //         return Redirect::to('login');
        //     }
        // }

    }

    public function logout()
    {
        auth()->logout();
        
        return view("user.logout");
    }


    

}

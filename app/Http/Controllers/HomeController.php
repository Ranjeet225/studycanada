<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\EnquiryMail;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $secondConnectionUsers = DB::connection('mysql_second')->table('users')->take(5)->get();
        dd($secondConnectionUsers);

        $country = DB::table('country')->select('name', 'id', 'country_code')->get();
        $slider = DB::table('sliders')->where('status', '1')->first();
        $countryId = $slider->country_id;
        $testimonials = DB::table('testimonials')->take(3)->get();
        $aboutcountry = DB::table('country_universities')->where('country_id', $countryId)->get();
        $universities = DB::table('universities')->where('country_id', $countryId)->get();
        $sliders = DB::table('sliders')->where('country_id', $countryId)->get();
        $countryName = $country->where('id', $countryId)->first();
        $sliderImages = [];
        foreach ($sliders as $slider) {
            $images = DB::table('images')->where('slider_id', $slider->id)->get();
            $sliderImages[] = $images;
        }

        return view('index', compact('universities', 'sliderImages', 'country', 'testimonials', 'countryName','aboutcountry'));
    }

    public function sendMail(Request $request)
    {
        $data = [
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email_id'=>$request->email_id,
            'phone_no'=>$request->phone_no,
            'location'=>$request->location,
            'city'=>$request->city,
        ];
        EnquiryMail::insert($data);
        Mail::to('ranjeetmaurya2033@gmail.com')->send(new WelcomeMail($data));
        return redirect()->route('index')->with('success','Mail Send Successfully');
    }

    public function getCountryData(Request $request)
    {
        // dd($request->countryId);
        $countryName=DB::table('country')->where('id',$request->countryId)->first();
        $universities = DB::table('universities')->where('country_id',$request->countryId)->get();
        $universityCount =$universities->count();
        $sliders = DB::table('sliders')->where('country_id',$request->countryId)->get();
        $sliderImages = [];
        foreach ($sliders as $slider) {
            $images = DB::table('images')->where('slider_id', $slider->id)->get();
            $sliderImages[] = $images;
        }
        return response()->json([
            'countryName'=>$countryName->name,
            'universities'=>$universities,
            'sliderimage'=>$sliderImages,
            'totalUniversity'=>$universityCount,
            'success'=>true
        ]);
        // return view('index',compact('universities','sliderImages','country','testimonials','countryName'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

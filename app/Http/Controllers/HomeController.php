<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\EnquiryMail;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $countryData = Http::get('https://overseaseducationlane.com/api/admin/country_list');
        if ($countryData->successful()) {
            $country = json_decode($countryData->body())->data;
        } else {
            $statusCode = $countryData->status();
        }
        $slider = DB::table('sliders')->where('status', '1')->first();
        $countryId = $slider->country_id;
        if(empty($countryId)){
            $countryId =82;
        }
        $testimonials = DB::table('testimonials')->take(3)->get();
        $universityData = Http::post('https://overseaseducationlane.com/api/get-university-by-country-name', [
            'country_id' =>$countryId,
        ]);
        if ($universityData->successful()) {
            $universities  = json_decode($universityData->body());
        } else {
            $statusCode = $universityData->status();
        }
        $countryName = Http::get('https://overseaseducationlane.com/api/admin/country_edit/'.$countryId);
        if ($countryName->successful()) {
            $countryName  = json_decode($countryName->body());
        } else {
            $statusCode = $countryName->status();
        }
        $aboutcountry = DB::table('country_universities')->where('country_id', $countryId)->get();
        $sliders = DB::table('sliders')->where('country_id', $countryId)->get();
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

        $countryName =  Http::get('https://overseaseducationlane.com/api/admin/country_edit/'.$request->countryId);
        if ($countryName->successful()) {
            $countryName  = json_decode($countryName->body());
        } else {
            $statusCode = $countryName->status();
        }
        $universityData = Http::post('https://overseaseducationlane.com/api/get-university-by-country-name', [
            'country_id' =>$request->countryId,
        ]);
        if ($universityData->successful()) {
            $universities  = json_decode($universityData->body());
        } else {
            $statusCode = $universityData->status();
        }
        $universityCount = count($universities);
        // $countryName=DB::table('country')->where('id',$request->countryId)->first();
        // $universities = DB::table('universities')->where('country_id',$request->countryId)->get();
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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get("/login",[AdminController::class,'index'])->name('admin');
Route::get("/logoutadmin",[AdminController::class,'logoutadmin'])->name('logoutadmin');
Route::post("adminlogin",[AdminController::class,'adminlogin'])->name('adminlogin');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get("/dashboard",[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get("/admin-profile",[AdminController::class,'adminprofile'])->name('admin.admin-profile');
    Route::post("/admin-change-password",[AdminController::class,'adminchangepassword'])->name('admin.admin-change-password');
    Route::post('/create-admin',[AdminController::class,'CreateAdmin'])->name('create-admin');
    Route::get('/edit-admin/{id}',[AdminController::class,'EditAdmin'])->name('edit-admin');
    Route::post("/update-admin",[AdminController::class,'UpdateAdmin'])->name('update-admin');
    Route::get("/admindelete/{id}",[AdminController::class,'admindelete'])->name('admindelete');
    //country
    Route::get("/country",[DashboardController::class,'getCountry'])->name('getCountry');
    Route::get("create/country",[DashboardController::class,'createCountry'])->name('create.country');
    Route::post("store/country",[DashboardController::class,'storeCountry'])->name('store.country');
    Route::get("edit/country/{id}",[DashboardController::class,'editCountry'])->name('edit.country');
    Route::post("update/country/{id}",[DashboardController::class,'updateCountry'])->name('update.country');
    Route::get("delete/country/{id}",[DashboardController::class,'deleteCountry'])->name('delete.country');
    //state
    Route::get("/state",[DashboardController::class,'getState'])->name('getState');
    Route::get("create/state",[DashboardController::class,'createState'])->name('create.state');
    Route::post("store/state",[DashboardController::class,'storeState'])->name('store.state');
    Route::get("edit/state/{id}",[DashboardController::class,'editState'])->name('edit.state');
    Route::post("update/state/{id}",[DashboardController::class,'updateState'])->name('update.state');
    Route::get("delete/state/{id}",[DashboardController::class,'deleteState'])->name('delete.state');
    // slider
    Route::get("getSlider",[DashboardController::class,'getSlider'])->name('getSlider');
    Route::get("create/slider",[DashboardController::class,'createSlider'])->name('create.slider');
    Route::get('/fetch-states', [DashboardController::class, 'fetchStates'])->name('states.get');
    Route::post("store/slider",[DashboardController::class,'storeSlider'])->name('store.slider');
    Route::get("edit/slider/{id}", [DashboardController::class, 'editSlider'])->name('edit.slider');
    Route::get("show/slider/{id}",[DashboardController::class,'showSlider'])->name('show.slider');
    Route::post("update/slider/{id}",[DashboardController::class,'updateSlider'])->name('update.slider');
    Route::get("delete/slider/{id}",[DashboardController::class,'deleteSlider'])->name('delete.slider');
    Route::post("update-slider-status",[DashboardController::class,'updateSliderStatus'])->name('statusUpdate');

    // university
    Route::get("university",[DashboardController::class,'getUniversity'])->name('getUniversity');
    Route::get("create/university",[DashboardController::class,'createUniversity'])->name('create.university');
    Route::post("university/store",[DashboardController::class,'storeUniversity'])->name('store.university');
    Route::get("edit/university/{id}",[DashboardController::class,'editUniversity'])->name('edit.university');
    Route::get("show/university/{id}",[DashboardController::class,'showUniversity'])->name('show.university');
    Route::post("update/university/{id}",[DashboardController::class,'updateUniversity'])->name('update.university');
    Route::get("delete/university/{id}",[DashboardController::class,'deleteUniversity'])->name('delete.university');
    // testimonials
    Route::get("testimonials",[DashboardController::class,'getTestimonials'])->name('getTestimonials');
    Route::get("create/testimonials",[DashboardController::class,'createTestimonials'])->name('create.testimonial');
    Route::post("testimonials/store",[DashboardController::class,'storeTestimonials'])->name('store.testimonial');
    Route::get("edit/testimonials/{id}",[DashboardController::class,'editTestimonials'])->name('edit.testimonial');
    Route::get("show/testimonials/{id}",[DashboardController::class,'showTestimonials'])->name('show.testimonial');
    Route::post("update/testimonials/{id}",[DashboardController::class,'updateTestimonials'])->name('update.testimonial');
    Route::get("delete/testimonials/{id}",[DashboardController::class,'deleteTestimonials'])->name('delete.testimonial');

    // indexpage Data'
    Route::get("emailData",[DashboardController::class,'emailData'])->name('emailData');
    Route::get("email-delete/{id}",[DashboardController::class,'emailDelete'])->name('emailDelete');

    // whycountry
    Route::get("country-university",[DashboardController::class,'countryUniversity'])->name('country.university');
    Route::get("create/country-university",[DashboardController::class,'createCountryUniversity'])->name('create.country.university');
    Route::post("country-university/store",[DashboardController::class,'storeCountryUniversity'])->name('store.country.university');
    Route::get("edit/country-university/{id}",[DashboardController::class,'editCountryUniversity'])->name('edit.country.university');
    Route::post("update/country-university/{id}",[DashboardController::class,'updateCountryUniversity'])->name('update.country.university');
    Route::get("delete/country-university/{id}",[DashboardController::class,'deleteCountryUniversity'])->name('delete.country.university');

});

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/get-country-data', [HomeController::class, 'getCountryData'])->name('get-country-data');
// Route::get('country/{id}',[HomeController::class,'getIndexPageData'])->name('country');
Route::post('send-mail',[HomeController::class,'sendMail'])->name('send-mail');

Route::fallback(function () {
    return view('errors.404');
});

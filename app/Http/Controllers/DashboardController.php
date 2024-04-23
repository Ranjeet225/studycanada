<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\Slider;
use App\Models\EnquiryMail;
use App\Models\Image;
use App\Models\CountryUniversity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // country
    public function getCountry()
    {
        $country=DB::table('country')->select('name','id','country_code')->paginate(10);
        return view('admin.country.index', compact('country'));
    }
    public function createCountry()
    {
        return view('admin.country.create');
    }
    public function storeCountry(Request $request)
    {
        DB::table('country')->insert([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'country_code'=>$request->country_code,
        ]);
        return redirect()->route('getCountry')->with('success', 'Country Added successfully.');
    }
    public function editCountry($id)
    {
        $country=DB::table('country')->find($id);
        return view('admin.country.edit', compact('country'));
    }
    public function updateCountry(Request $request,$id)
    {
        DB::table('country')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'country_code' => '+'.$request->country_code,
        ]);
        return redirect()->route('getCountry')->with('success', 'Country Updated successfully.');
    }
    public function deleteCountry($id)
    {
        $deleted = DB::table('country')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->route('getCountry')->with('success', 'Country deleted successfully.');
        } else {
            return redirect()->route('getCountry')->with('error', 'Failed to delete country.');
        }
    }
    // state
    public function getState()
    {

        $state=State::select('name','id')->paginate(10);
        return view('admin.state.index', compact('state'));
    }

    public function createState()
    {
        $country=DB::table('country')->get();
        return view('admin.state.create',compact('country'));
    }

    public function storeState(Request $request)
    {
        State::insert([
            'country_id'=>$request->country,
            'name'=>$request->name,
        ]);
        return redirect()->route('getState')->with('success', 'State Added successfully.');
    }

    public function editState($id)
    {
        $state=State::find($id);
        $country=DB::table('country')->get();
        return view('admin.state.edit', compact('state','country'));
    }

    public function updateState(Request $request,$id)
    {
        State::where('id', $id)
        ->update([
            'country_id'=>$request->country,
            'name' => $request->name,
        ]);
        return redirect()->route('getState')->with('success', 'State Updated successfully.');
    }

    public function deleteState($id)
    {
        $deleted = State::where('id', $id)->delete();

        if ($deleted) {
            return redirect()->route('getState')->with('success', 'State deleted successfully.');
        } else {
            return redirect()->route('getState')->with('error', 'Failed to delete State.');
        }
    }
    // slider
    public function getSlider()
    {

        $slider = Slider::with('images')->paginate(10);
        return view('admin.slider.index', compact('slider'));
    }
    public function createSlider()
    {
        $countries=DB::table('country')->get();
        return view('admin.slider.create',compact('countries'));
    }
    public function fetchStates(Request $request)
    {
        $country_id = $request->input('country_id');
        $states = State::where('country_id', $country_id)->pluck('name', 'id');
        return response()->json($states);
    }
    public function storeSlider(Request $request)
    {
        $slider = Slider::create([
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'title' => $request->title,
        ]);
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $uploadedImage) {
                $imageName = time() . '_' . $uploadedImage->getClientOriginalName();
                $imagePath = 'assets/sliderimage/' . $imageName;
                $uploadedImage->move(public_path('assets/sliderimage'), $imageName);
                $image = Image::create([
                    'slider_id'=>$slider->id,
                    'filename' => $imageName,
                    'filepath' => $imagePath,
                ]);
            }
        }
        return redirect()->route('getSlider')->with('success', 'Slider added successfully.');
    }
    public function showSlider($id)
    {
        $slider=Slider::with('images')->find($id);
        return view('admin.slider.show', compact('slider'));
    }
    public function editSlider($id)
    {
        $slider=Slider::find($id);
        $countries=DB::table('country')->get();
        return view('admin.slider.edit', compact('slider','countries'));
    }
    public function updateSlider(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update([
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'title' => $request->title,
        ]);
        if ($request->hasFile('images')) {
            foreach ($slider->images as $image) {
                $imagePath = public_path($image->filepath);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }
            foreach ($request->file('images') as $uploadedImage) {
                $imageName = time() . '_' . $uploadedImage->getClientOriginalName();
                $imagePath = 'assets/sliderimage/' . $imageName;
                $uploadedImage->move(public_path('assets/sliderimage'), $imageName);
                Image::create([
                    'slider_id' => $slider->id,
                    'filename' => $imageName,
                    'filepath' => $imagePath,
                ]);
            }
        }
        return redirect()->route('getSlider')->with('success', 'Slider updated successfully.');
    }
    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        if (!$slider) {
            return redirect()->route('getSlider')->with('error', 'Slider not found.');
        }
        $images = Image::where('slider_id', $id)->get();
        foreach ($images as $image) {
            $imagePath = public_path($image->filepath);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $image->delete();
        }
        $deleted = $slider->delete();
        if ($deleted) {
            return redirect()->route('getSlider')->with('success', 'Slider deleted successfully.');
        } else {
            return redirect()->route('getSlider')->with('error', 'Failed to delete Slider.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */

     public function getUniversity()
     {
         $university=DB::table('universities')->paginate(10);
         return view('admin.university.index', compact('university'));
     }
     public function createUniversity()
     {
        $countries=DB::table('country')->get();
         return view('admin.university.create',compact('countries'));
     }
     public function storeUniversity(Request $request)
     {
         $requestData = $request->except('_token');
         if ($request->hasFile('logo')) {
             $logo = $request->file('logo');
             $logoName = time() . '.' . $logo->getClientOriginalExtension();
             $logo->move(public_path('admin/uploads/university'), $logoName);
         } else {
             return redirect()->back()->withInput()->withErrors(['logo' => 'The logo field is required.']);
         }
         if ($request->hasFile('banner')) {
             $banner = $request->file('banner');
             $bannerName = time() . '.' . $banner->getClientOriginalExtension();
             $banner->move(public_path('admin/uploads/university'), $bannerName);
         } else {
             return redirect()->back()->withInput()->withErrors(['banner' => 'The banner field is required.']);
         }
         $data = array_merge($requestData, ['logo' => $logoName, 'banner' => $bannerName]);
         DB::table('universities')->insert($data);
         return redirect()->route('getUniversity')->with('success', 'University Added successfully.');
     }


     public function editUniversity($id)
     {
         $university=DB::table('universities')->find($id);
         $countries=DB::table('country')->get();
         return view('admin.university.edit', compact('university','countries'));
     }

     public function updateUniversity(Request $request, $id)
     {
         $updateData = [
            'country_id' =>$request->country_id,
            'state' =>$request->state,
            'university_name' =>$request->university_name,
            'university_slug' =>$request->university_slug,
            'university_location' =>$request->university_location,
            'city' =>$request->city,
            'zip' =>$request->zip,
            'phone_number' =>$request->phone_number,
            'email' =>$request->email,
            'type_of_university' =>$request->type_of_university,
            'founded_in' =>$request->founded_in,
            'total_students' =>$request->total_students,
            'international_students' =>$request->international_students,
            'size_of_campus' =>$request->size_of_campus,
            'male_female_ratio' =>$request->male_female_ratio,
            'faculty_student_ratio' =>$request->faculty_student_ratio,
            'yearly_hostel_expense_amount' =>$request->yearly_hostel_expense_amount,
            'yearly_hostel_expense_currencies' =>$request->yearly_hostel_expense_currencies,
            'financial_aid' =>$request->financial_aid,
            'placement' =>$request->placement,
            'accomodation' =>$request->accomodation,
            'accomodation_details' =>$request->accomodation_details,
            'website2' =>$request->website2,
            'application_cost' =>$request->application_cost,
            'application_cost_currencies' =>$request->application_cost_currencies,
            'fafsa_code' =>$request->fafsa_code,
            'notes' =>$request->notes,
            'added_by_name' =>$request->added_by_name,
            'added_on_date' =>$request->added_on_date,
            'details' =>$request->details,
         ];
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('admin/uploads/university'), $logoName);
            $updateData['logo'] = $logoName;
        }
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $bannerName = time() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('admin/uploads/university'), $bannerName);
            $updateData['banner'] = $bannerName;
        }
         DB::table('universities')->where('id', $id)->update($updateData);
         return redirect()->route('getUniversity')->with('success', 'University Updated successfully.');
     }

     public function deleteUniversity($id)
     {
         $university = DB::table('universities')->where('id', $id)->first();
         $logoPath = public_path('admin/uploads/university/' . $university->logo);
         $bannerPath = public_path('admin/uploads/university/' . $university->banner);
         if (File::exists($logoPath)) {
             File::delete($logoPath);
         }
         if (File::exists($bannerPath)) {
             File::delete($bannerPath);
         }
         $deleted = DB::table('universities')->where('id', $id)->delete();
         if ($deleted) {
             return redirect()->route('getUniversity')->with('success', 'University deleted successfully.');
         } else {
             return redirect()->route('getUniversity')->with('error', 'Failed to delete University.');
         }
     }

    // Testimonial
    public function getTestimonials()
    {

        $testimonial = DB::table('testimonials')->paginate(10);
        return view('admin.testimonial.index', compact('testimonial'));
    }
    public function createTestimonials()
    {
        return view('admin.testimonial.create');
    }
    public function storeTestimonials(Request $request)
    {
        $requestData = $request->except('_token');
        if ($request->hasFile('profile_picture')) {
            $picture = $request->file('profile_picture');
            $profilePIcture = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('admin/uploads/testimonials'), $profilePIcture);
        } else {
            return redirect()->back()->withInput()->withErrors(['Profile Picture' => 'The Profile field is required.']);
        }
        $created_by= Auth::user()->id;
        $data = array_merge($requestData, ['profile_picture' => $profilePIcture,'created_by'=>$created_by]);
        DB::table('testimonials')->insert($data);
        return redirect()->route('getTestimonials')->with('success', 'Testimonial added successfully.');
    }
    public function editTestimonials($id)
    {
        $testimonial=DB::table('testimonials')->find($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }
    public function updateTestimonials(Request $request,$id)
    {
        $updateData = [
            'name' => $request->name,
            'designation' => $request->designation,
            'location' => $request->location,
            'status' => $request->status,
            'testimonial_desc' => $request->testimonial_desc,
        ];
        if ($request->hasFile('profile_picture')) {
            $picture = $request->file('profile_picture');
            $profilePIcture = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('admin/uploads/testimonials'), $profilePIcture);
            $updateData['profile_picture'] = $profilePIcture;
        }
        DB::table('testimonials')->where('id', $id)->update($updateData);
        return redirect()->route('getTestimonials')->with('success', 'testimonial Updated successfully.');
    }
    public function deleteTestimonials($id)
    {
        $testimonial = DB::table('testimonials')->where('id', $id)->first();
        $testimonialimagePath = public_path('admin/uploads/testimonials/' . $testimonial->profile_picture);
        if (File::exists($testimonialimagePath)) {
            File::delete($testimonialimagePath);
        }
        $deleted = DB::table('testimonials')->where('id', $id)->delete();
        if ($deleted) {
            return redirect()->route('getTestimonials')->with('success', 'testimonial deleted successfully.');
        } else {
            return redirect()->route('getTestimonials')->with('error', 'Failed to delete testimonial.');
        }
    }

    public function getIndexPageData(Request $request)
    {
        $universities = DB::table('universities')->where('country_id',$request->country_id)->get();
        $testimonials = DB::table('testimonials')->get();
        $sliders = DB::table('sliders')->where('country_id',$request->country_id)->get();
        $sliderImages = [];
        foreach ($sliders as $slider) {
            $images = DB::table('images')->where('slider_id', $slider->id)->get();
            $sliderImages[$slider->id] = $images;
        }
        return response()->json([
            'universities' => $universities,
            'testimonials' => $testimonials,
            'sliderImages' => $sliderImages,
        ]);
    }

    /**
     * Display the speefied resource.
     */
    public function emailData()
    {
        $emailData=EnquiryMail::paginate(10);
        return view('admin.sendEmail.index',compact('emailData'));
    }

    public function emailDelete($id)
    {
        $deleted = EnquiryMail::find($id)->delete();
        if ($deleted) {
            return redirect()->route('emailData')->with('success', 'Email deleted successfully.');
        } else {
            return redirect()->route('emailData')->with('error', 'Failed to delete country.');
        }
    }

    public function updateSliderStatus(Request $request)
    {
        $sliderId = $request->input('slider_id');
        DB::table('sliders')->update(['status' => '0']);
        DB::table('sliders')->where('id', $sliderId)->update(['status' => '1']);
        return response()->json(['message' => 'Status updated successfully']);
    }


    public function countryUniversity()
    {
        $countryuniversity=CountryUniversity::paginate(10);
        return view('admin.countryuniversity.index',compact('countryuniversity'));
    }
    public function createCountryUniversity()
    {
        $countries=DB::table('country')->get();
        return view('admin.countryuniversity.create',compact('countries'));
    }
    public function storeCountryUniversity(Request $request)
    {
        if ($request->hasFile('image')) {
            $picture = $request->file('image');
            $profilePIcture = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('admin/uploads/aboutcountry'), $profilePIcture);
        } else {
            return redirect()->back()->withInput()->withErrors(['image' => 'The image field is required.']);
        }
        DB::table('country_universities')->insert([
            'country_id'=>$request->country_id,
            'aboutcountry'=>$request->aboutcountry,
            'image'=>$profilePIcture,
        ]);

        return redirect()->route('country.university')->with('success', 'Country Added successfully.');
    }
    public function editCountryUniversity($id)
    {
        $aboutCountry= DB::table('country_universities')->find($id);
        $countries=DB::table('country')->get();
        return view('admin.countryuniversity.edit', compact('aboutCountry','countries'));
    }
    public function updateCountryUniversity(Request $request, $id)
    {
        $updateData = [
            'country_id' => $request->country_id,
            'aboutcountry' => $request->aboutcountry,
        ];
        if ($request->hasFile('image')) {
            $picture = $request->file('image');
            $profilePIcture = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('admin/uploads/aboutcountry'), $profilePIcture);
            $updateData['image'] = $profilePIcture;
        }

        DB::table('country_universities')
            ->where('id', $id)
            ->update($updateData);

        return redirect()->route('country.university')->with('success', 'Country Updated successfully.');
    }

    public function deleteCountryUniversity($id)
    {
        $deleted = DB::table('country_universities')->where('id', $id)->delete();
        if ($deleted) {
            return redirect()->route('country.university')->with('success', 'Country deleted successfully.');
        } else {
            return redirect()->route('country.university')->with('error', 'Failed to delete country.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

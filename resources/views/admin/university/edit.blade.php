@include('admin.common.header')
@include('admin.common.sidebar')
<style>
    #results {
        display: flex;
        flex-flow: wrap;
    }
</style>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        {{-- <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Validation</a></li>
            </ol>
        </div> --}}
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <span id="responseMessage" class="pd-4"></span>
                    <div class="card-header">
                        <h4 class="card-title">Edit University</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="{{route('update.university',[$university->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Select Country</label>
                                            <select class="form-control" name="country_id" id="country">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if ($country->id == $university->country_id) @selected(true) @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                    {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Select State</label>
                                            <select class="form-control" name="state" id="state">
                                                <option value="" >Select State</option>
                                            </select>
                                            @error('state_id')
                                                    {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Enter University</label>
                                            <input type="text" name="university_name" class="form-control"
                                                placeholder="University name" value="{{$university->university_name}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Enter University Slug</label>
                                            <input type="text" name="university_slug" value="{{$university->university_slug}}" class="form-control"
                                                placeholder="University Slug" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Enter University Location</label>
                                            <input type="text" name="university_location" value="{{$university->university_location}}"  class="form-control"
                                                placeholder="University Location" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control"
                                                placeholder="city" value="{{$university->city}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Zip</label>
                                            <input type="title" name="zip"  value="{{$university->zip}}" class="form-control"
                                                placeholder="zip" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <input type="number" name="phone_number"  value="{{$university->phone_number}}" class="form-control"
                                                placeholder="phone_number" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" value="{{$university->email}}" class="form-control"
                                                placeholder="email" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Website</label>
                                            <input type="url" name="website" value="{{$university->website}}" class="form-control"
                                                placeholder="website" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Logo</label>
                                            <input type="file" name="logo" value="{{$university->website}}"  class="form-control"
                                                placeholder="website" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Type of University </label>
                                            <select class="form-control" name="type_of_university" id="type_of_university">
                                                @php
                                                    $universityType = DB::table('university_ranking')->get();
                                                @endphp
                                                @foreach ($universityType as $item)
                                                    <option value="{{ $item->id }}" @if ($item->id == $university->type_of_university)
                                                   @selected(true) @endif>{{ $item->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Founded In </label>
                                            <input type="number" name="founded_in" class="form-control"
                                                  value="{{$university->founded_in}}">
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Total Students </label>
                                            <input type="number" name="total_students" class="form-control"
                                            value="{{$university->total_students}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">International Students </label>
                                            <input type="text" name="international_students" class="form-control"
                                            value="{{$university->international_students}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">size of Campus </label>
                                            <input type="text" name="size_of_campus" class="form-control"
                                            value="{{$university->size_of_campus}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Male Female Ratio </label>
                                            <input type="number" name="male_female_ratio" class="form-control"
                                            value="{{$university->male_female_ratio}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Faculty Student Ratio </label>
                                            <input type="number" name="faculty_student_ratio" class="form-control"
                                            value="{{$university->faculty_student_ratio}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Yearly Hostal Amount </label>
                                            <input type="number" name="yearly_hostel_expense_amount" class="form-control"
                                            value="{{$university->yearly_hostel_expense_amount}}">
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Yearly Hostal Expense</label>
                                            <input type="number" name="yearly_hostel_expense_currencies" class="form-control"
                                            value="{{$university->yearly_hostel_expense_currencies}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Yearly Hostal Expense</label>
                                            <input type="number" name="yearly_hostel_expense_currencies" class="form-control"
                                            value="{{$university->yearly_hostel_expense_currencies}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Financial Aid</label>
                                            <input type="text" name="financial_aid" class="form-control"
                                            value="{{$university->financial_aid}}">
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Placement</label>
                                            <input type="text" name="placement" class="form-control"
                                            value="{{$university->placement}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Accomodation</label>
                                            <input type="text" name="accomodation" class="form-control"
                                            value="{{$university->accomodation}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Accomodation Details</label>
                                            <input type="text" name="accomodation_details" class="form-control"
                                            value="{!!$university->accomodation_details!!}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Website2</label>
                                            <input type="url" name="website2" class="form-control"
                                            value="{{$university->website2}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Application  Cost</label>
                                            <input type="text" name="application_cost" class="form-control"
                                            value="{{$university->application_cost}}">
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Application  Cost Currencies</label>
                                            <input type="text" name="application_cost_currencies" class="form-control"
                                            value="{{$university->application_cost_currencies}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Fafsa Code</label>
                                            <input type="text" name="fafsa_code" class="form-control"
                                            value="{{$university->fafsa_code}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Notes</label>
                                            <input type="text" name="notes" class="form-control"
                                            value="{{$university->notes}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    @php
                                        $user =Auth::user();
                                    @endphp
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Added By Name</label>
                                            <input type="text" name="added_by_name" class="form-control"
                                                value="{{$user->name}}" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Added By Date</label>
                                            <input type="date" name="added_on_date" class="form-control" placeholder="Added by Date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Banner</label>
                                            <input type="file" name="banner" class="form-control">
                                            <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Details</label>
                                            <textarea name="details" class="form-control" cols="30" rows="5">{!! $university->details !!}</textarea>
                                            <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                </div>
                                    <button  type="submit" class="btn btn-primary w-25 float-end">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{asset('admin/assets/js/jquery-3.7.1.js')}}"></script>
<script>
    $(document).ready(function(){
        function fetchStates(country_id) {
            $('#state').empty();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: "{{ route('states.get') }}",
                method: 'get',
                data: {
                    country_id: country_id
                },
                success: function(data){
                    if ($.isEmptyObject(data)) {
                        $('#state').append('<option value="">No records found</option>');
                    } else {
                        $.each(data, function(key, value){
                            $('#state').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                }
            });
        }
        fetchStates($('#country').val());
        $('#country').change(function(){
            var country_id = $(this).val();
            fetchStates(country_id);
        });
    });

</script>

<!--**********************************
    Content body end
***********************************-->
@include('admin.common.footer')


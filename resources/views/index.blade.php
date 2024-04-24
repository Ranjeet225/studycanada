@extends('layouts.app')
@section('style')
    <style>
        .flag-icon {
            display: inline-block;
            width: 40px;
            /* Adjust the width and height as needed */
            height: 40px;
            border-radius: 50%;
            /* This creates the circular shape */
            overflow: hidden;
            /* Hides any parts of the image that exceed the circular shape */
            border: 1px solid #ccc;
            /* Optional: Add border for better visibility */
        }

        .flag-icon img {
            width: 100%;
            /* Ensures the image fills the circular container */
            height: auto;
            /* Allows the image to scale proportionally */
        }
    </style>
    <style>
        /* CSS for spinner */
        .blockMsg,.blockPage,.blockUI{
            background-color:transparent !important;
            border:none !important;
        }
        .spinner {
            border-top: 4px solid #333;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: auto;
            margin-top: 15px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endsection
@section('content')
    <div class="wraper">
        <div class="banner">
            <div class="treeSectins">
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <div class="form-group col-md-12 mb-0 bannerbutton rounded">
                            <div class="row " style="display: flex;margin-top:40px;border-radius:10px">
                                {{-- <form action="{{ route('index') }}" method="get" class="col-md-12 "> --}}
                                {{-- <select class="custom-select" id="inputGroupSelect04" name="country" style="height: 40px">
                                            @foreach ($country as $data)
                                                    <option value="{{ $data->name }}"  data-value="{{ $data->name }}"  @if (request()->has('country') && request()->country == $data->name) selected @endif>{{ substr($data->name,0,22) }}</option>
                                            @endforeach
                                        </select> --}}
                                {{-- <form id="countryForm" action="{{route('index')}}" method="GET">
                                            <select class="custom-select" id="inputGroupSelect04" name="country" style="height: 40px">
                                                @foreach ($country as $data)
                                                    <option value="{{ $data->name }}" @if (request()->has('country') && request()->country == $data->id) selected @endif>{{ substr($data->name,0,22) }}</option>
                                                @endforeach
                                            </select>
                                        </form> --}}
                                {{-- <form id="countryForm" action="{{ route('index') }}" method="GET"> --}}
                                <div class="input-group" style="width: 300px">
                                    <select class="custom-select form-control" id="inputGroupSelect04" name="country"
                                        style="height: 40px;">
                                        <option>Select Country</option>
                                        @foreach ($country as $data)
                                            <option value="{{ $data->id }}"
                                                @if (request()->has('country') && request()->country == $data->id) selected @endif>
                                                {{ substr($data->name, 0, 22) }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                {{-- </form> --}}

                                {{-- <div class="input-group-append">
                                          <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-search" aria-hidden="true"></i></button>
                                        </div> --}}
                                {{-- <div class="col-md-10 ">
                                        <select class="form-control " style="height: 40px" name="country" id="country">
                                            <option value="">--Select Country--</option>
                                            @foreach ($country as $data)
                                                <option value="{{ $data->name }}"  @if (request()->has('country') && request()->country == $data->name) selected @endif>{{ substr($data->name,0,22) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="float: right;margin-top:-41px">
                                        <button type="submit" class="btn btn-primary" style="height: 40px;"><i
                                            class="fa fa-search" aria-hidden="true"></i></button>
                                    </div> --}}
                                {{-- </form> --}}
                            </div>
                        </div>
                        {{-- <section class="section wrapper wrapper-section" style="margin-top: 50% !important">
                            <div class="container wrapper-column">
                               <form name="country" class="form" id="form">
                                  <div class="form-group">
                                     <select name="country" id="country" class="dropdown" onchange="myFunction()">
                                        <option value="">-- Select Country --</option>
                                        @foreach ($country as $data)
                                            <option value="{{ $data->name }}"  @if (request()->has('country') && request()->country == $data->name) selected @endif> {{ substr($data->name,0,22) }}</option>
                                        @endforeach
                                     </select>
                                  </div>
                               </form>
                            </div>
                        </section> --}}
                    </div>



                    <div class="col-md-3 " style="text-align: center;">
                        <div class="bannergirl">
                            <img src="{{ asset('assets/images1/redgirl.png') }}" style="width:76%;height:500px" />
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <div class="formcontent BannerFOrm">
                            <!-- <h4>  in CANADA</h4> -->
                            <h2  class="study-in">
                                Study in {{ $countryName->name }}
                                {{-- <a href="" class="typewrite" data-period="2000"
                                    data-type='[{{ $allCountriesString }}]'>
                                    <span class="wrap"></span>
                                </a> --}}
                            </h2>
                            <p class="get-admission"> Get admission into world-renowned universities in {{ $countryName->name }}
                            </p>
                            <form action="{{ route('send-mail') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class=" mb-15 col-md-6">
                                        <input class="from-control" type="text" required id="first_name"
                                            name="first_name" placeholder="First Name" value="">
                                    </div>
                                    <div class=" mb-15 col-md-6">
                                        <input class="from-control" type="text" required name="last_name"
                                            placeholder="Last Name" value="">
                                    </div>
                                    <div class=" mb-15 col-md-12">
                                        <input class="from-control" type="text" required name="email_id"
                                            placeholder="Email" value="">
                                    </div>
                                    <div class=" mb-15 col-md-12">
                                        <input class="from-control" type="text" required name ="phone_no"
                                            placeholder="Phone" value="">
                                    </div>
                                    <div class=" mb-15 col-md-12">
                                        <input class="from-control" type="text" required name="location"
                                            placeholder="Location" value="">
                                    </div>
                                    <div class=" mb-15 col-md-12">
                                        <input class="from-control" type="text" required name="city"
                                            placeholder="City" value="">
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <button type="submit" class="apply-btn"
                                            style="background-image: linear-gradient(to right, #0452b8, #38d0da);padding: 5px 20px;display: inline-block;margin-top: 6px;border-radius: 6px;color: white;width: 100%;text-align: center;">
                                            Submit now <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
            </div>
            <div id="demo" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner sliderData">
                    @if (!empty($sliderImages[0]) && count($sliderImages[0]) > 0)
                        @foreach ($sliderImages[0] as $key => $item)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }} ">
                                <img src="{{ asset($item->filepath) }}" width="100%" height="590px !important">
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/images1/banner/banner1.png') }}" width="100%"
                                height="590px !important">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images1/banner/banner2.png') }}" width="100%"
                                height="590px !important">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images1/banner/banner3.png') }}" width="100%"
                                height="590px !important">
                        </div>
                    @endif
                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <section class="snddiv">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="studyStudent"
                            style="    font-size: 25px;
                    font-weight: 700;
                    color: #1086f3;">
                            66,000+ Indian students choose to study in {{ $countryName->name }}
                        </h5>
                        <div class="row">
                            <div class="col-md-4">
                                <h5
                                    style="    font-size: 25px;
                            font-weight: 700;
                            color: #1086f3;">
                                    You could be the next</h5>
                            </div>
                            {{-- <div class="col-md-4">
                            <a class="apply-btn" href="#"
                                style="background-image: linear-gradient(to right, #38d0da , #38d0da);padding: 5px 20px;
                                        display: inline-block;  margin-top: 6px;  border-radius: 6px;color: white;width: 100%;
                                        text-align: center;">
                                Talk to a counsellor <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                        </div> --}}
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </section>
        <section class="bluebackgrouns">
            <div class="container">
                <h4 class="whycanada"> Why {{ $countryName->name }}</h4>
                </h4>
                <div class="flex-container">
                    {{-- admin/uploads/aboutcountry --}}
                    @if ($aboutcountry->count() > 0)
                        @foreach ($aboutcountry as $item)
                            <div class="whyimg text-white text-capitalize " style="font-size: 15px;">
                                <img src="{{ asset('admin/uploads/aboutcountry') }}/{{ $item->image }}"
                                    style="border-radius:100%;">
                                {!! $item->aboutcountry !!}
                            </div>
                        @endforeach
                    @else
                        <div class="whyimg">
                            <img src="{{ asset('assets/images1/why1.png') }}">
                            <p class="whycanadapara"> 37 universities ranked invthe top 500 universities in the world.</p>
                        </div>
                        <div class="whyimg">
                            <img src="{{ asset('assets/images1/why2.png') }}">
                            <p class="whycanadapara"> 37 universities ranked invthe top 500 universities in the world.</p>
                        </div>
                        <div class="whyimg">
                            <img src="{{ asset('assets/images1/why3.png') }}">
                            <p class="whycanadapara"> 37 universities ranked invthe top 500 universities in the world.</p>
                        </div>
                        <div class="whyimg">
                            <img src="{{ asset('assets/images1/why4.png') }}">
                            <p class="whycanadapara"> 37 universities ranked invthe top 500 universities in the world.</p>
                        </div>
                        <div class="whyimg">
                            <img src="{{ asset('assets/images1/why5.png') }}">
                            <p class="whycanadapara"> 37 universities ranked invthe top 500 universities in the world.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="">
            <div class="container">
                <div class="sec-title text-center">
                    <h4 class="univerheading universitycount"> Over {{ $universities->count() }} + Universities and Colleges to study in
                       {{ $countryName->name }}
                    </h4>
                    <p class="findourheading"> Find out which
                    {{ $countryName->name }} universities are a good match for youracademic
                    profile</p>
                    <br>
                </div>
                <div class="row">
                </div>
            </div>
        </section>
        <section class="pinkback">
            <div class="container">
                <div class="sec-title text-center">
                    <div class="row universityData">
                        @foreach ($universities as $item)
                            <div class="col-md-4 ">
                                <div class="card">
                                    @if (!empty($item->banner))
                                        <img class="card-img-top"
                                            src="{{ asset('admin/uploads/university') }}/{{ $item->banner }}"
                                            alt="Card image cap">
                                    @endif
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 unipd">
                                                @if (!empty($item->banner))
                                                    <img
                                                        src="{{ asset('admin/uploads/university') }}/{{ $item->banner }}">
                                                @endif
                                            </div>
                                            <div class="col-md-9 align-self-center">
                                                <h5 class="unihd"> {{ $item->university_name }}</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <ul class="deslist">
                                                    <li> <svg class="status-svg" width="27" height="20"
                                                            viewBox="0 0 27 27" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_1103)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M19.1728 1.47705C23.3572 1.47705 26.1688 4.41436 26.1688 8.78571V18.9729C26.1688 23.3442 23.3572 26.2814 19.1728 26.2814H8.36033C4.17588 26.2814 1.36432 23.3442 1.36432 18.9729V8.78571C1.36432 4.41436 4.17588 1.47705 8.36033 1.47705H19.1728ZM19.1728 3.20759H8.36033C5.16229 3.20759 3.09486 5.39616 3.09486 8.78571V18.9729C3.09486 22.3624 5.16229 24.5509 8.36033 24.5509H19.1728C22.3719 24.5509 24.4382 22.3624 24.4382 18.9729V8.78571C24.4382 5.39616 22.3719 3.20759 19.1728 3.20759ZM8.4262 10.9402C8.90383 10.9402 9.29147 11.3279 9.29147 11.8055V19.7199C9.29147 20.1975 8.90383 20.5852 8.4262 20.5852C7.94857 20.5852 7.56093 20.1975 7.56093 19.7199V11.8055C7.56093 11.3279 7.94857 10.9402 8.4262 10.9402ZM13.8105 7.15149C14.2881 7.15149 14.6757 7.53913 14.6757 8.01676V19.7187C14.6757 20.1963 14.2881 20.5839 13.8105 20.5839C13.3329 20.5839 12.9452 20.1963 12.9452 19.7187V8.01676C12.9452 7.53913 13.3329 7.15149 13.8105 7.15149ZM19.1063 15.1223C19.584 15.1223 19.9716 15.51 19.9716 15.9876V19.7187C19.9716 20.1963 19.584 20.5839 19.1063 20.5839C18.6287 20.5839 18.2411 20.1963 18.2411 19.7187V15.9876C18.2411 15.51 18.6287 15.1223 19.1063 15.1223Z"
                                                                    fill="black" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_1103">
                                                                    <rect width="26.3042" height="26.3042" fill="white"
                                                                        transform="translate(0.210571 0.322998)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg> Current Status - Admission Open</li>
                                                    <li> <svg class="fees-svg" width="31" height="20"
                                                            viewBox="0 0 31 27" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_1108)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M21.4865 0.533691C25.9975 0.533691 29.6671 4.20315 29.6671 8.71562V18.5059C29.6671 23.0169 25.9975 26.6878 21.4865 26.6878H9.69506C5.18395 26.6878 1.51312 23.0169 1.51312 18.5059V8.71562C1.51312 4.20315 5.18395 0.533691 9.69506 0.533691H21.4865ZM21.4865 2.57987H9.69506C6.31206 2.57987 3.55928 5.33264 3.55928 8.71562V18.5059C3.55928 21.8888 6.31206 24.6417 9.69506 24.6417H21.4865C24.8694 24.6417 27.6208 21.8888 27.6208 18.5059V18.1238L23.1221 18.1247C20.5344 18.1247 18.4283 16.0199 18.4268 13.4335C18.4268 10.8445 20.5331 8.73828 23.1221 8.73691L27.6208 8.73609V8.71562C27.6208 5.33264 24.8694 2.57987 21.4865 2.57987ZM27.6208 10.7823L23.1221 10.7831C21.6612 10.7844 20.4731 11.9726 20.4731 13.4322C20.4731 14.8904 21.6625 16.0786 23.1221 16.0786L27.6208 16.0777V10.7823ZM23.7463 12.3245C24.311 12.3245 24.7694 12.7829 24.7694 13.3476C24.7694 13.9123 24.311 14.3707 23.7463 14.3707H23.3207C22.756 14.3707 22.2976 13.9123 22.2976 13.3476C22.2976 12.7829 22.756 12.3245 23.3207 12.3245H23.7463ZM16.0887 6.72416C16.6534 6.72416 17.1117 7.1825 17.1117 7.74725C17.1117 8.31199 16.6534 8.77032 16.0887 8.77032H8.72381C8.15907 8.77032 7.70072 8.31199 7.70072 7.74725C7.70072 7.1825 8.15907 6.72416 8.72381 6.72416H16.0887Z"
                                                                    fill="black"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_1108">
                                                                    <rect width="29.5923" height="26.3042" fill="white"
                                                                        transform="translate(0.566284 0.533691)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg> Approximate Fees(€) - €72 to 102/Sem</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group col-md-12 mb-0">
                                            <a class="apply-btn" href="{{ $item->website }}"
                                                style="background-image: linear-gradient(to right, #0452b8 , #38d0da);padding: 5px 20px;
                                    display: inline-block;  margin-top: 6px;  border-radius: 6px;color: white;width: 100%;
                                    text-align: center;">
                                                View now </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        </section>
        <section class="">
            <div class="container">
                <div class="sec-title text-center">
                    <p class="countrystudentheading"> More than 42,000 Indian students studying <br> in
                     {{ $countryName->name }}
                    </p>
                </div>
                <div class="row">
                    @foreach ($testimonials as $data)
                        <div class="col-md-4">
                            <div class="card customcard ">
                                @if (!empty($data->profile_picture))
                                    <img class="card-img-top"
                                        src="{{ asset('admin/uploads/testimonials') }}/{{ $data->profile_picture }}"
                                        alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 align-self-center">
                                            <h5 class="unihd"> {{ $data->name }}</h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <p>{!! $data->testimonial_desc !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="col-md-4">
                    <div class="card customcard  bhoomika">
                        <img class="card-img-top" src="{{asset('assets/images1/vin.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 align-self-center">
                                    <h5 class="unihd"> Bhoomika Sanagaram </h5>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <p> She is our esteemed client who
                                        approached Y-Axis to get her German
                                        student visa process done. Y-Axis
                                        helped her to achieve her dream of
                                        studying in Germany.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card customcard">
                        <img class="card-img-top" src="{{asset('assets/images1/grgirl.png')}}" alt="Card image cap">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 align-self-center">
                                    <h5 class="unihd"> Bhoomika Sanagaram </h5>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <p> She is our esteemed client who
                                        approached Y-Axis to get her German
                                        student visa process done. Y-Axis
                                        helped her to achieve her dream of
                                        studying in Germany.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
        </section>
        <section class="bluebackgrouns loaded">
            <div class="container">
                <h4 class="whycanada"> The OEl Advantage </h4>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="checklist">
                            <li> <i class="fa fa-check cmcheck" aria-hidden="true"></i> Our approach is Right Course,
                                Right Path</li>
                            <li> <i class="fa fa-check cmcheck" aria-hidden="true"></i> One Stop Shop for everything
                                Study Abroad</li>
                            <li> <i class="fa fa-check cmcheck" aria-hidden="true"></i> Unbiased & Personalized
                                counselling</li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <ul class="checklist">
                            <li> <i class="fa fa-check cmcheck" aria-hidden="true"></i> Result driven Test-prep
                                training </li>
                            <li> <i class="fa fa-check cmcheck" aria-hidden="true"></i> 1000s of success stories
                                (Test-Prep & Admissions)</li>
                            <li> <i class="fa fa-check cmcheck" aria-hidden="true"></i> Partners beyond Studies (Post
                                Study Employment Assistance) </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-6 pt-30 pb-30">
                        <h2 class="number"> 1M + </h2>
                    </div>
                    <div class="col-md-3 col-6 pt-30 pb-30">
                        <h2 class="number"> 100k + </h2>
                    </div>
                    <div class="col-md-3 col-6 pt-30 pb-30">
                        <h2 class="number"> 50 + </h2>
                    </div>
                    <div class="col-md-3 col-6 pt-30 pb-30">
                        <h2 class="number"> 20 + </h2>
                    </div>
                    <div class="form-group col-md-5">
                    </div>
                    <div class="form-group col-md-2">
                        <a class="apply-btn" href="#"
                            style="background:white;
                display: inline-block;  margin-top: 6px;  border-radius: 6px;color: blue;width: 100%;  padding: 10px 0px;
                text-align: center;">
                            Check Eligibility <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                    </div>
                    <div class="form-group col-md-5">
                    </div>
                </div>
            </div>
        </section>
        <h4 class="weare"> we are all over </h4>
        <div class="mainlogodiv mb-10 mt-10">
            <div class="slick marquee">
                @foreach ($country as $item)
                    <div class="slick-slide">
                        <div class="inner logobkl">
                            <div class="row">
                                {{-- <div class="col-md-6 crlimg">
                            <img src="{{ asset('assets/images1/aaa.jpg') }}" style="border-radius:60px;width:30px">
                        </div> --}}

                                <div class="col-md-6 crlimg">
                                    <h4 class="aus text-nowrap" style="text-align: center">
                                        {{ substr($item->name, 0, 10) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- 2ndcarousel -->

            <div dir="rtl">
                <div class="slick marquee_rtl">
                    @foreach ($country as $item)
                        <div class="slick-slide">
                            <div class="inner logobkl">
                                <div class="row">
                                    {{-- <div class="col-md-6 crlimg">
                                <img src="{{ asset('assets/images1/aaa.jpg') }}" style="border-radius: 50px">
                            </div> --}}
                                    <div class="col-md-6 crlimg">
                                        <h4 class="ausleft text-nowrap"> {{ substr($item->name, 0, 10) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <section class="girlback">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="girldiv">
                            <h4 class="Chooseheading"> Choose the right course &<br>achieve your goals </h4>
                            <div class="row">
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Business Administration
                                </div>
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Computer Science & IT
                                </div>
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Engineering
                                </div>
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Natural Sciences
                                </div>
                                <div class="col-md-6  col-12 btmpoint">
                                    <li class="dash"> </li> Medicine
                                </div>
                                <div class="col-md-6  col-12 btmpoint">
                                    <li class="dash"> </li> Teaching
                                </div>
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Law
                                </div>
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Computer Science
                                </div>
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Social Work
                                </div>
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Mathematics
                                </div>
                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Nursing
                                </div>

                                <div class="col-md-6 col-12 btmpoint">
                                    <li class="dash"> </li> Nursing
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
        </section>
        <div class="rs-newsletter">
            <div class="container">
                <div class="newsletter-wrap">
                    <div class="row ">
                        <div class=" col-md-8">
                            <div class="content-part">
                                <div class="sec-title">
                                    <h3 class="title mb-0 white-color"> Discover OEL . It's easier than you think.</h3>
                                </div>
                                <p class="footerp"> Stay assured, we are always available. </p>
                            </div>
                        </div>
                        <div class="col-md-2">
                        </div>

                        <div class="form-group col-md-2">
                            <a class="apply-btn" href="#"
                                style="background:white;
                                display: inline-block;  margin-top: 6px;  border-radius: 6px;color: blue;width: 100%;  padding: 10px 0px;
                                text-align: center;">
                                Contact us <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#inputGroupSelect04').select2({
                    placeholder: 'Search...'
                });
                $('#inputGroupSelect04').on('change', function() {
                    var countryId = $(this).val();
                    $.blockUI({ message: '<div class="spinner"></div><h4>Loading...</h4>' });
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('get-country-data') }}",
                        type: 'POST',
                        data: {
                            countryId: countryId
                        },
                        success: function(response) {
                            if (response.success) {
                                if (response.countryName) {
                                    $('.countryName').text(response.countryName);
                                    $('.study-in').text(`Study in ${ response.countryName }`);
                                    $('.studyStudent').text(`66,000+ Indian students choose to study in ${ response.countryName }`);
                                    $('.get-admission').text(`Get admission into world-renowned universities in ${ response.countryName }`);
                                    $('.whycanada').text(`Why ${ response.countryName }`);
                                    $('.findourheading').text(`Find out which ${ response.countryName } universities are a good match for youracademic profile`);
                                    $('.countrystudentheading').text(`More than 42,000 Indian students studying in ${ response.countryName }`);
                                }
                                if (response.universities) {
                                    $('.universityData').empty();
                                    $.each(response.universities, function(index, item) {
                                        console.log(item);
                                        var html = '<div class="col-md-4">' +
                                            '<div class="card">' +
                                            '<div class="card-body">' +
                                            '<div class="row">' +
                                            '<div class="col-md-3 unipd">' +
                                            '<img src="{{ asset('admin/uploads/university') }}/' +
                                            item.banner + '">' +
                                            '</div>' +
                                            '<div class="col-md-9 align-self-center">' +
                                            '<h5 class="unihd">' + item.university_name +
                                            '</h5>' +
                                            '</div>' +
                                            '<div class="col-md-12">' +
                                            '<ul class="deslist">' +
                                            '<li> <svg class="status-svg" width="27" height="20" viewBox="0 0 27 27" fill="none">' +
                                            '<path fill-rule="evenodd" clip-rule="evenodd" d="M19.1728 1.47705C23.3572 1.47705 26.1688 4.41436 26.1688 8.78571V18.9729C26.1688 23.3442 23.3572 26.2814 19.1728 26.2814H8.36033C4.17588 26.2814 1.36432 23.3442 1.36432 18.9729V8.78571C1.36432 4.41436 4.17588 1.47705 8.36033 1.47705H19.1728ZM19.1728 3.20759H8.36033C5.16229 3.20759 3.09486 5.39616 3.09486 8.78571V18.9729C3.09486 22.3624 5.16229 24.5509 8.36033 24.5509H19.1728C22.3719 24.5509 24.4382 22.3624 24.4382 18.9729V8.78571C24.4382 5.39616 22.3719 3.20759 19.1728 3.20759ZM8.4262 10.9402C8.90383 10.9402 9.29147 11.3279 9.29147 11.8055V19.7199C9.29147 20.1975 8.90383 20.5852 8.4262 20.5852C7.94857 20.5852 7.56093 20.1975 7.56093 19.7199V11.8055C7.56093 11.3279 7.94857 10.9402 8.4262 10.9402ZM13.8105 7.15149C14.2881 7.15149 14.6757 7.53913 14.6757 8.01676V19.7187C14.6757 20.1963 14.2881 20.5839 13.8105 20.5839C13.3329 20.5839 12.9452 20.1963 12.9452 19.7187V8.01676C12.9452 7.53913 13.3329 7.15149 13.8105 7.15149ZM19.1063 15.1223C19.584 15.1223 19.9716 15.51 19.9716 15.9876V19.7187C19.9716 20.1963 19.584 20.5839 19.1063 20.5839C18.6287 20.5839 18.2411 20.1963 18.2411 19.7187V15.9876C18.2411 15.51 18.6287 15.1223 19.1063 15.1223Z" fill="black" /></svg> Current Status - Admission Open</li>' +
                                            '<li> <svg class="fees-svg" width="31" height="20" viewBox="0 0 31 27" fill="none">' +
                                            '<path fill-rule="evenodd" clip-rule="evenodd" d="M21.4865 0.533691C25.9975 0.533691 29.6671 4.20315 29.6671 8.71562V18.5059C29.6671 23.0169 25.9975 26.6878 21.4865 26.6878H9.69506C5.18395 26.6878 1.51312 23.0169 1.51312 18.5059V8.71562C1.51312 4.20315 5.18395 0.533691 9.69506 0.533691H21.4865ZM21.4865 2.57987H9.69506C6.31206 2.57987 3.55928 5.33264 3.55928 8.71562V18.5059C3.55928 21.8888 6.31206 24.6417 9.69506 24.6417H21.4865C24.8694 24.6417 27.6208 21.8888 27.6208 18.5059V18.1238L23.1221 18.1247C20.5344 18.1247 18.4283 16.0199 18.4268 13.4335C18.4268 10.8445 20.5331 8.73828 23.1221 8.73691L27.6208 8.73609V8.71562C27.6208 5.33264 24.8694 2.57987 21.4865 2.57987ZM27.6208 10.7823L23.1221 10.7831C21.6612 10.7844 20.4731 11.9726 20.4731 13.4322C20.4731 14.8904 21.6625 16.0786 23.1221 16.0786L27.6208 16.0777V10.7823ZM23.7463 12.3245C24.311 12.3245 24.7694 12.7829 24.7694 13.3476C24.7694 13.9123 24.311 14.3707 23.7463 14.3707H23.3207C22.756 14.3707 22.2976 13.9123 22.2976 13.3476C22.2976 12.7829 22.756 12.3245 23.3207 12.3245H23.7463ZM16.0887 6.72416C16.6534 6.72416 17.1117 7.1825 17.1117 7.74725C17.1117 8.31199 16.6534 8.77032 16.0887 8.77032H8.72381C8.15907 8.77032 7.70072 8.31199 7.70072 7.74725C7.70072 7.1825 8.15907 6.72416 8.72381 6.72416H16.0887Z" fill="black"></path>' +
                                            '</g></svg> Approximate Fees(€) - €72 to 102/Sem</li>' +
                                            '</ul>' +
                                            '</div>' +
                                            '</div>' +
                                            '<hr>' +
                                            '<div class="form-group col-md-12 mb-0">' +
                                            '<a class="apply-btn" href="' + item.website +
                                            '" style="background-image: linear-gradient(to right, #0452b8 , #38d0da);padding: 5px 20px; display: inline-block; margin-top: 6px; border-radius: 6px;color: white;width: 100%;text-align: center;">View now</a>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>';
                                        $('.universityData').append(html);
                                    });
                                }
                                if (response.totalUniversity || response.countryName) {
                                    var data = `Over ${response.totalUniversity} + Universities and Colleges to study in ${response.countryName}`;
                                    $('.universitycount').text(data);
                                }
                                if (response.sliderimage && response.sliderimage.length > 0) {
                                    $('.sliderData').empty();
                                    console.log(response.sliderimage);
                                    $.each(response.sliderimage[0], function(key, imageitem) {
                                        var slider = '<div class="carousel-item ' + (key === 0 ? 'active' : '') + '">' +
                                                    '<img src="' + imageitem.filepath + '" width="100%" height="590px !important">' +
                                                    '</div>';
                                        $('.sliderData').append(slider);
                                    });
                                }else{
                                    $('.sliderData').empty();
                                    var slider =` <div class="carousel-item active">
                                                <img src="{{ asset('assets/images1/banner/banner1.png') }}" width="100%"
                                                    height="590px !important">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ asset('assets/images1/banner/banner2.png') }}" width="100%"
                                                        height="590px !important">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ asset('assets/images1/banner/banner3.png') }}" width="100%"
                                                        height="590px !important">
                                                </div>`;
                                    $('.sliderData').append(slider);

                                }
                            } else {
                                // Handle the case where success is false
                            }
                            $.unblockUI();
                        },
                        error: function(xhr, status, error) {
                            $.unblockUI();
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        {{-- <script src="{{asset('admin/assets/js/jquery-3.7.1.js')}}"></script> --}}
    @endsection

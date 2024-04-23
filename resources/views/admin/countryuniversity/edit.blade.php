@include('admin.common.header')
@include('admin.common.sidebar')
<style>
    #results {
        display: flex;
        flex-flow: wrap;
    }
</style>
{{-- <script src="{{asset('admin/assets/js/ckeditor.js')}}"></script> --}}
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
{{-- <script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script> --}}
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
                        <h4 class="card-title">Edit About Country University</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="{{route('update.country.university',[$aboutCountry->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Select Country</label>
                                            <select class="form-control" name="country_id" id="country" >
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if ($aboutCountry->country_id == $country->id) @selected(true)   @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                    {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Feature Image</label>
                                            <input type="file" name="image" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">About Country University</label>
                                            <textarea name="aboutcountry" required>{!! $aboutCountry->aboutcountry !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                    <button  type="submit" class="btn btn-primary w-25 float-right">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->
<script>
    CKEDITOR.replace( 'aboutcountry' );
</script>
@include('admin.common.footer')


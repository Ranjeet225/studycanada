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
                        <h4 class="card-title">Upload Slider Image</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="{{route('store.slider')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Select Country</label>
                                            <select class="form-control" name="country_id" id="country">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                                            <select class="form-control" name="state_id" id="state">
                                                <option value="">Select State</option>
                                            </select>
                                            @error('state_id')
                                                    {{$message}}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Enter title</label>
                                            <input type="text" name="title" class="form-control"
                                                placeholder="title" >
                                                <span class="text-danger name"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Upload Slider</label>
                                            <input type="file" name="images[]" multiple class="form-control"
                                                placeholder="name" required>
                                                <span class="text-danger name"></span>
                                            @error('images')
                                                {{$message}}
                                            @enderror
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


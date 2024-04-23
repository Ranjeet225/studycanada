@include('admin.common.header')
@include('admin.common.sidebar')
<!--**********************************
 Content body start
***********************************-->

<div class="content-body">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader">
                        <div class="cpa">
                            <i class="fa-solid fa-file-lines me-1"></i>Email List
                        </div>
                    </div>
                    <div class="cm-content-body form excerpt">
                        <div class="card-body pb-4">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email Id</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>City</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if ($emailData->count() > 0)
                                        @foreach ($emailData as $item)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                                <td>{{ $item->email_id }}</td>
                                                <td>{{ $item->phone_no }}</td>
                                                <td>{{ $item->location }}</td>
                                                <td>{{ $item->city }}</td>
                                                <td class="text-nowrap">
                                                    <a title="Delete" href="{{ route('emailDelete',[$item->id]) }}" class="btn btn-warning btn-sm content-icon">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">Data Not Found!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    {{-- <p class="mb-2 me-3">Page 1 of 5, showing 2 records out of 8 total, starting on record 1, ending on 2</p> --}}
                                    <nav aria-label="Page navigation example mb-2">
                                        <ul class="pagination mb-2 mb-sm-0">
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $emailData->previousPageUrl() }}">
                                                    <i class="fa-solid fa-angle-left"></i>
                                                </a>
                                            </li>

                                            <!-- Display each page link -->
                                            @for ($i = 1; $i <= $emailData->lastPage(); $i++)
                                                <li class="page-item {{ $emailData->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $emailData->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            <li class="page-item">
                                                <a class="page-link" href="{{ $emailData->nextPageUrl() }}">
                                                    <i class="fa-solid fa-angle-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.common.footer')

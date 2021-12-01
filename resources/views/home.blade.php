@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom card-stretch gutter-b" style="border-radius: 21px;">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Selamat Datang</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="javascript:" class="btn btn-danger font-weight-bolder font-size-sm logout">Log Out</a>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                <thead>
                                    <tr class="text-left text-uppercase">
                                        <th style="min-width: 250px" class="pl-7">
                                            <span class="text-dark-75">WELCOME</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pl-0 py-8">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50 symbol-light mr-4">
                                                    <span class="symbol symbol-35 symbol-light-success">
                                                        <span class="symbol-label font-size-h5 font-weight-bold">
                                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                        </span>
                                                    </span>
                                                </div>
                                                <div>
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ Auth::user()->name }}</a>
                                                    <span class="text-muted font-weight-bold d-block">
                                                        {{ Auth::user()->department->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script src="{{ url('/') }}/assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/animate.css" />

<script type="text/javascript">

   
</script>
@endpush

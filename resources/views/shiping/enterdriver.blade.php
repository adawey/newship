@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
<title>
    - اضافة شحنه
</title>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="text-muted mt-1 tx-13 mr-2 mb-0"> الشحنات </h4><span class="content-title mb-0 my-auto">/ {{$shiping->typ->name ?? "" }}
                </span>
            </div>
        </div>
    </div>
    <style>
        .select2-container{
            width: 100% !important;
        }
        @media (min-width: 992px) {
    .modal-lg, .modal-xl {
        max-width: 80%;
    }
}
        </style>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div id='content'>
        <div>


            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <p>
                            <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button"
                                aria-expanded="false" id="addd" aria-controls="multiCollapseExample1"> اضافة سائق </a>
                            <button class="btn btn-warning" type="button" data-toggle="collapse"
                                data-target="#multiCollapseExample2" aria-expanded="false"
                                aria-controls="multiCollapseExample2"> بحث </button>
                        </p>
                        <div class="row">
                            <div class="col">
                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    <div class="card card-body">
                                        <div class="row">

                                            <div class="col-lg-3 ">
                                                <label class="form-label"> السائق </label>
                                                <select id="driver_id" class="form-control ">
                                                    <option value=""> اختر </option>
                                                    <option v-for="(st , sti) in drivers" :key="sti"
                                                        :value="st.id">
                                                        @{{ st.name }} </option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 ">
                                                <label class="form-label"> رقم السياره </label>
                                                <input class="form-control" id="car_number" placeholder="00" type="text">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-header pb-0 collapse multi-collaps" id="multiCollapseExample1"
                            style="background-color: lightgray;">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0"> تفاصيل شحنه </h4>
                            </div>
                            @include('shiping.form')
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-md-nowrap" id="shiping">
                                    <thead>
                                        <tr>
                                            <th> id</th>
                                            <th> اسم السائق </th>
                                            <th> رقم السياره </th>
                                            <th> رقم المقطوره </th>
                                            <th> تاريخ الوصول </th>
                                            @if ($shiping->type == 1)
                                                {{-- // لو الشحنه رفح  --}}
                                                <th> تاريخ التحميل </th>
                                            @endif
                                           
                                            <th> فرق الوصول </th>
                                            <th> تاريخ التعتيق </th>
                                            <th> الاجمالي </th>
                                            <th> العهده </th>
                                            <th> السلفه </th>
                                            <th> الصافي </th>
                                            <th> اجمالي السائق </th>
                                            <th> اجراءات </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row closed -->
        </div>
        @include('shiping.datamodel')
        @include('shiping.pay')
        @include('driver.modelnew')
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>

    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    @include('vue')
    @include('shiping.js')
  
@endsection

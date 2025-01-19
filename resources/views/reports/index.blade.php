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
    - التقارير
</title>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="text-muted mt-1 tx-13 mr-2 mb-0"> التقارير </h4><span class="content-title mb-0 my-auto">/
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div id='content'>
        <div>


            <div class="row">
                <div class="col-xl-12">
                    <div class="card">

                        <div class="row">
                            <div class="col">
                                <hr>
                                <div class="card card-body">
                                    <div class="row">
                                        <div class=" col-md-6 mt-4 mb-5">
                                            <h6> تقرير العربيه </h6>
                                            <form id="createEmployee" autocomplete="off">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12 ">
                                                        <label class="form-label"> رقم السياره </label>
                                                        <input class="form-control" id="carnum" type="text">
                                                    </div>
                                                    <br>
                                                    <div class=" col-12 mt-4">
                                                        <button type="button" id="carnumb"
                                                            class="btn btn-primary btn-lg btn-block"> طباعه
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class=" col-md-6 mt-4 mb-5">
                                            <h6> تقرير الشحنه </h6>
                                            <form autocomplete="off">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12 ">
                                                        <label class="form-label"> رقم الشحنه </label>
                                                        <input class="form-control" id="shipnumberReport" type="text">

                                                    </div>
                                                    <br>

                                                    <div class=" col-12 mt-4">
                                                        <button id="shipnumber" type="button"
                                                            class="btn btn-primary btn-lg btn-block"> طباعه
                                                        </button>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                        <div class=" col-md-6 mt-4 mb-5">
                                            <h6> تقرير عدد السيارات </h6>
                                            <form method="POST" action="{{ route('reports.typereport') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class=" col-md-12 ">
                                                        <label class="my-1 mr-2"> حسب تاريخ
                                                        </label>
                                                        <select name="type" class="form-control" required>
                                                            <option value="" selected> --حدد --</option>
                                                            <option value="1"> التحميل </option>
                                                            <option value="2"> التعتيق </option>
                                                        </select>
                                                    </div>
                                                    <div class=" col-md-6 ">
                                                        <label class="form-label"> من </label>
                                                        <input class="form-control" name="from" type="date">
                                                    </div>
                                                    <div class=" col-md-6 ">
                                                        <label class="form-label"> الي </label>
                                                        <input class="form-control" name="to" type="date">
                                                    </div>
                                                    <div class=" col-md-12 ">
                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> العنوان
                                                        </label>
                                                        <select name="type_id" class="form-control" required>
                                                            <option value="" selected> --حدد --</option>
                                                            <option value="1"> رفح </option>
                                                            <option value="2"> العوجه </option>
                                                            <option value="3"> الغاز </option>
                                                        </select>
                                                    </div>

                                                    <br>
                                                    <div class=" col-12 mt-4">
                                                        <button type="submit" class="btn btn-primary btn-lg btn-block"> جرد
                                                        </button>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                        <div class=" col-md-6 mt-4 mb-5">
                                            <h6> حساب العربيات --- </h6>
                                            <form method="POST" action="{{ route('reports.carstatus') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class=" col-md-12 ">
                                                        <label class="my-1 mr-2"> حسب تاريخ
                                                        </label>
                                                        <select name="type" class="form-control" required>
                                                            <option value="" selected> --حدد --</option>
                                                            <option value="1"> التحميل </option>
                                                            <option value="2"> التعتيق </option>
                                                        </select>
                                                    </div>
                                                    <div class=" col-md-6 ">
                                                        <label class="form-label"> من </label>
                                                        <input class="form-control" name="from" type="date">
                                                    </div>
                                                    <div class=" col-md-6 ">
                                                        <label class="form-label"> الي </label>
                                                        <input class="form-control" name="to" type="date">
                                                    </div>

                                                    <div class=" col-md-6 ">
                                                        <label class="my-1 mr-2"> العنوان
                                                        </label>
                                                        <select name="type_id" class="form-control" required>
                                                            <option value="" selected> --حدد --</option>
                                                            <option value="1"> رفح </option>
                                                            <option value="2"> العوجه </option>
                                                            <option value="3"> الغاز </option>
                                                        </select>
                                                    </div>
                                                    <div class=" col-md-6 ">
                                                        <label class="my-1 mr-2"> الحاله
                                                        </label>
                                                        <select name="status" class="form-control" required>
                                                            <option value="" selected> --حدد --</option>
                                                            <option value="1"> منتهيه الحساب </option>
                                                            <option value="2"> غير منتهيه </option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class=" col-12 mt-4">
                                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                            جرد
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class=" col-md-6 mt-4 mb-5">
                                            <h6> حساب العربيات من غير تاريخ تعتيق</h6>
                                            <form method="POST" action="{{ route('reports.carsnotdecharge') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class=" col-md-12 ">
                                                        <label class="my-1 mr-2"> حسب تاريخ
                                                        </label>
                                                        <select disabled name="type" class="form-control" required>
                                                            {{-- <option value="" selected> --حدد --</option> --}}
                                                            <option value="1" selected> التحميل </option>
                                                        </select>
                                                    </div>
                                                    <div class=" col-md-6 ">
                                                        <label class="form-label"> من </label>
                                                        <input class="form-control" name="from" type="date">
                                                    </div>
                                                    <div class=" col-md-6 ">
                                                        <label class="form-label"> الي </label>
                                                        <input class="form-control" name="to" type="date">
                                                    </div>
                                                    <div class=" col-md-12 ">
                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> العنوان
                                                        </label>
                                                        <select name="type_id" class="form-control" required>
                                                            <option value="" selected> --حدد --</option>
                                                            <option value="1"> رفح </option>
                                                            <option value="2"> العوجه </option>
                                                            <option value="3"> الغاز </option>
                                                        </select>
                                                    </div>

                                                    <br>
                                                    <div class=" col-12 mt-4">
                                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                            جرد
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class=" col-md-6 mt-4 mb-5">
                                            <h6> تقرير عهدة المندوب </h6>
                                            <form method="POST" action="{{ route('reports.vendorpaymentsreport') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class=" col-md-6 ">
                                                        <label class="form-label"> من </label>
                                                        <input class="form-control" name="from" type="date">
                                                    </div>
                                                    <div class=" col-md-6 ">
                                                        <label class="form-label"> الي </label>
                                                        <input class="form-control" name="to" type="date">
                                                    </div>
                                                    <div class=" col-md-12 ">
                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> المندوب
                                                        </label>
                                                        <select name="id" class="form-control" required>
                                                            <option value="" selected> --حدد المندوب --</option>
                                                            @foreach (\App\Models\User::all() as $depp)
                                                                <option value="{{ $depp->id }}">{{ $depp->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <br>

                                                    <div class=" col-12 mt-4">
                                                        <button type="submit" 
                                                            class="btn btn-primary btn-lg btn-block"> طباعه
                                                        </button>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
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
    <script>
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        $('#carnumb').on('click', function(e) {
            // new Promise(resolve => setTimeout(resolve, 5000));
            console.log("h")
            e.preventDefault();
            Swal.showLoading()
            const supurl = new URL('{{ route('reports.carnumreport') }}');
            let carnum = $('#carnum').val() ? $('#carnum').val() : null;
            supurl.searchParams.set('carnum', carnum);
            printPdf(supurl)
        });
        $('#shipnumber').on('click', function(e) {
            console.log("h")
            e.preventDefault();
            Swal.showLoading()
            const supurl = new URL('{{ route('reports.shipnumber') }}');
            let shipnumberReport = $('#shipnumberReport').val() ? $('#shipnumberReport').val() : null;
            supurl.searchParams.set('shipnumberReport', shipnumberReport);
            printPdf(supurl)
        });
    </script>
@endsection

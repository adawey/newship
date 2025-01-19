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
                <h4 class="text-muted mt-1 tx-13 mr-2 mb-0"> الشحنات </h4><span class="content-title mb-0 my-auto">/
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
                        <div class="card-header pb-0">
                            <div class="row">

                                <form id="createEmployee" method="post" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="id" value="{{ $type->id }}">
                                        <div class=" col-6 mt-4 ">
                                            <label for="exampleInputEmail1"> النوع </label>
                                            <input type="text" class="form-control" name="name" value="{{ $type->name }}">
                                        </div>
                                        <div class=" col-6 mt-4 ">
                                            <label for="exampleInputEmail1"> عدد ايام الرحله  </label>
                                            <input type="text" class="form-control" name="days" value="{{ $type->days }}">
                                        </div>
                                        <div class=" col-6 mt-4 ">
                                            <label for="exampleInputEmail1">  فرق المبيت    </label>
                                            <input type="text" class="form-control" name="daystwo" value="{{ $type->daystwo }}">
                                        </div>
                                        <div class=" col-6 mt-4 ">
                                            <label for="exampleInputEmail1"> المبيت </label>
                                            <input type="text" class="form-control" name="overnightone" value="{{ $type->overnightone }}">
                                        </div>
                                        <div class=" col-6 mt-4 ">
                                            <label for="exampleInputEmail1"> النولون </label>
                                            <input type="text" class="form-control" name="nolon" value="{{ $type->nolon }}">
                                        </div>
                                        <div class=" col-6 mt-4 ">
                                            <label for="exampleInputEmail1"> المبيت 2 </label>
                                            <input type="text" class="form-control" name="overnight" value="{{ $type->overnight }}">
                                        </div>
                                        @if($type->parent_id !== null )
                                        <div class=" col-4 mt-4">
                                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> ينتمي الي </label>
                                            <select name="parent_id" class="form-control" required>
                                                <option value="" selected disabled> --حدد النوع--</option>
                                                @foreach (\App\Models\Type::all() as $branche)
                                                    <option value="{{ $branche->id }}">{{ $branche->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif

                                        <div class=" col-lg-8">
                                            <button type="button" @click="saveData" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </div>


                                </form>

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
    <script>
     
        content = new Vue({
            'el': '#content',
            data: {
                supplier_err: '',
                drivers: [],
                driver_id: '',
                name_ar: '',
                name_fr: '',
                name: '',
                error: []
            },
            methods: {
                validation: function(el, msg) {
                    if (el == '') {
                        this.error.push({
                            'err': 'err'
                        });
                        swal({
                            title: msg,
                            type: 'warning',
                            confirmButtonText: 'موافق',
                        });
                        return 0;
                    }
                },
                saveData: function(e) {
                    e.preventDefault();
                    let formData = new FormData(document.getElementById('createEmployee'));
                    Swal.showLoading()

                    axios.post('{{ route('types.update') }}', formData).then(response => {
                        if (response.data.err == true) {
                            swal({
                                title: response.data.message,
                                type: 'warning',
                                confirmButtonText: 'موافق',
                            });
                        } else {
                            swal({
                                title: response.data.message,
                                type: 'success',
                                confirmButtonText: 'موافق',
                            });
                        }
                        // $('#shiping').DataTable().draw();
                    }).catch(response => {
                        console.log(response);
                        swal({
                            title: response.response.data.message,
                            type: 'warning',
                            confirmButtonText: 'موافق',
                        });
                        // $('#shiping').DataTable().draw();
                    })
                    // if (sav !== true) {
                    //     
                    // }

                }
            },
            created() {}
        });
    </script>
@endsection

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
    - الاعدادات
</title>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="text-muted mt-1 tx-13 mr-2 mb-0"> الاعدادات </h4><span class="content-title mb-0 my-auto">/
                      </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row" id="content">

        <div class="col-lg-12 col-md-12" id='content'>
            <div class="card">
                <div class="card-body">
                    <form id="createEmployee" method="post" autocomplete="off">
                        @csrf
                        <div class="row mt-4">
                        <div class=" col-lg-4 mt-4">
                            <label for="exampleInputEmail1">   ايام الوصول    </label>
                            <input type="text" class="form-control"  name="ship_number">
                        </div>
                        <div class=" col-lg-4 mt-4">
                            <label for="exampleInputEmail1">   فرق النولون   </label>
                            <input type="text" class="form-control"  name="ship_number">
                        </div>
                        <div class=" col-lg-4 mt-4">
                            <label for="exampleInputEmail1">   مبيت     </label>
                            <input type="text" class="form-control"  name="ship_number">
                        </div>
                        <div class=" col-lg-4 mt-4">
                            <label for="exampleInputEmail1">  رقم الشحنة  </label>
                            <input type="text" class="form-control"  name="ship_number">
                        </div>
                        <div class=" col-lg-4 mt-4">
                            <label for="exampleInputEmail1">  رقم الشحنة  </label>
                            <input type="text" class="form-control"  name="ship_number">
                        </div>
                        
                        <div class=" col-lg-4 mt-4">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> النوع </label>
                            <select name="type" class="form-control" required>
                                <option value="" selected disabled> --حدد النوع--</option>
                                <option value="1">  سكر   </option>
                                <option value="2">  مواد غذائية </option>
                                <option value="2">  رفح  </option>
                            </select>
                        </div>
                        <div class=" col-lg-4 mt-4">
                            <label for="exampleInputEmail1">  اسم العميل   </label>
                            <input type="text" class="form-control"  name="client">
                        </div>
                        
                        <div class=" col-lg-4 mt-4">
                            <button type="button" @click="saveData" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                        

                    </form>
                </div>
            </div>
        </div>
        @include('driver.modelnew')
    </div>
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
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
                supplier_err:'',
                drivers:[],
                driver_id:'',
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

                    axios.post('{{ route('shiping.store') }}', formData).then(response => {
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
                    }).catch(response => {
                        console.log(response);
                        swal({
                            title: response.response.data.message,
                            type: 'warning',
                            confirmButtonText: 'موافق',
                        });
                    })
                    // if (sav !== true) {
                    //     $('#employeestable').DataTable().draw();
                    // }

                },
                async newsuplier(e) {
                    e.preventDefault();
                    let formData = new FormData(document.getElementById('createsuplier'));
                    // Swal.showLoading()

                    axios.post('{{ route('driver.store') }}', formData).then(response => {
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
                            $('#exampleModal').modal('hide');
                             this.getdrivers();
                        }
                    }).catch(response => {
                        console.log(response);
                        this.supplier_err = response.response.data.message
                        // swal({
                        //     title: response.response.data.message,
                        //     type: 'warning',
                        //     confirmButtonText: 'موافق',
                        // });
                    })
                },
                async getdrivers(e) {
                    url = '{{ route('driver.json') }}',
                        axios.get(url).then(response => {
                            this.drivers = response.data.data;
                        })
                },
            },
            created() {
                this.getdrivers();
                
            }
        });
    </script>
@endsection

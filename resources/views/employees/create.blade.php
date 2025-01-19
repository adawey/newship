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
    - اضافة موظف
</title>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="text-muted mt-1 tx-13 mr-2 mb-0">الموظفين</h4><span class="content-title mb-0 my-auto">/
                    بيانات موظف </span>
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
                        <input type="hidden" value="0" class="form-control" name="type">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم الموظف</label>
                            <input type="text" class="form-control" value="" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> الايميل </label>
                            <input type="email" class="form-control" value="" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> الجوال </label>
                            <input type="text" class="form-control" name="phone" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان</label>
                            <input type="text" class="form-control" value="" name="location">
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">الباسبور</label>
                            <input type="file" class="form-control" value="" name="passporst">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الاقامة</label>
                            <input type="file" class="form-control" value="" name="accommodation">
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" @click="saveData" class="btn btn-primary">حفظ</button>
                            <button type="button" onclick="window.location.href='{{ route('employees.index') }}';"
                                class="btn btn-secondary"> اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

                    axios.post('{{ route('employees.store') }}', formData).then(response => {
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
                            window.location.assign(
                                '{{ route('employees.index') }}');
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

                }
            }
        });
    </script>
@endsection

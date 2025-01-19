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
                        <div class="row">
                            <div class="col">

                                <div class="card card-body">

                                    <form id="createEmployee" method="post" autocomplete="off">
                                        @csrf
                                        <div class="row mt-4">
                                            <input type="hidden" class="form-control" name="id" value="{{ $ship->id }}">
                                            <div class=" col-md-4 mt-4">
                                                <label for="exampleInputEmail1"> رقم الشحنة </label>
                                                <input type="text" class="form-control" name="ship_number" value="{{ $ship->ship_number }}">
                                            </div>
                                            @if ($ship->type == 1)
                                            <div class=" col-md-4 mt-4">
                                                <label for="exampleInputEmail1">  اسم العميل   </label>
                                                <input type="text" class="form-control" name="client_name" value="{{ $ship->client_name }}">
                                            </div>
                                            <div class=" col-md-4 mt-4">
                                                <label for="exampleInputEmail1">  نوع الحموله  </label>
                                                <input type="text" class="form-control" value="{{ $ship->typeof }}" name="typeof">
                                            </div>
                                            <div class=" col-md-4 mt-4">
                                                <label for="exampleInputEmail1">  مكان الحموله  </label>
                                                <input type="text" class="form-control" value="{{ $ship->addof }}" name="addof">
                                            </div>
                                            @endif
                                           
                                            
                                            @if ($ship->type == 2)

                                            <div class=" col-md-4 mt-4">
                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> ع 1  </label>
                                                <select name="addtwo"   class="form-control" required>
                                                    <option value="" selected > --حدد --</option>
                                                        <option  {{ $ship->addtwo == 1 ? 'selected' : '' }} value="1"> سكر </option>
                                                        <option {{ $ship->addtwo == 2 ? 'selected' : '' }} value="2"> سيراميك </option>
                                                        <option {{ $ship->addtwo == 3 ? 'selected' : '' }} value="3"> مواد غذائيه </option>
                                                </select>
                                            </div>
                                            @if ($ship->addthree !== null)
                                            <div class=" col-md-4 mt-4" v-if="addtwo == 1" >
                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> ع2  </label>
                                                <select name="addthree"   class="form-control" required>
                                                    <option value="" selected > --حدد --</option>
                                                        <option {{ $ship->addthree == 1 ? 'selected' : '' }} value="1"> سكر </option>
                                                        <option {{ $ship->addthree == 2 ? 'selected' : '' }} value="2"> جامبو </option>
                                                        <option {{ $ship->addthree == 3 ? 'selected' : '' }} value="3"> شكاير </option>
                                                </select>
                                            </div>
                                            @endif


                                            @endif
                                            <div class=" col-12 mt-4">
                                                <button type="button" @click="saveData"
                                                    class="btn btn-primary">حفظ</button>
                                            </div>
                                        </div>


                                    </form>

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
                parent: false,
                supplier_err: '',
                parent_id: '',
                types: [],
                newarray: [],
                chtypes: [],
                drivers: [],
                type: {{ $ship->type    }},
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

                    axios.post('{{ route('shiping.update') }}', formData).then(response => {
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
                async gettypes(e) {
                    url = '{{ route('types.json') }}',
                        axios.get(url).then(response => {
                            this.types = response.data.data.filter(item => item.parent_id == null);
                            this.chtypes = response.data.data.filter(item => item.parent_id !== null);
                            // this.types = response.data.data;
                        })
                },
                async gettypeschildren() {
                    this.newarray = this.chtypes.filter(item => item.parent_id == this.type);
                    if (this.newarray.length > 0) {
                        this.parent = true;
                    } else {
                        this.parent = false;
                    }
                }
            },
            created() {
                this.gettypes()
            }
        });
    </script>
@endsection

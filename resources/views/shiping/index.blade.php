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
                                            <div class=" col-md-4 mt-4">
                                                <label for="exampleInputEmail1"> رقم الشحنة </label>
                                                <input type="text" class="form-control" name="ship_number">
                                            </div>
                                            @if ($typeid == 1)
                                                <div class=" col-md-4 mt-4">
                                                    <label for="exampleInputEmail1"> اسم العميل </label>
                                                    <input type="text" class="form-control" name="client_name">
                                                </div>
                                                <div class=" col-md-4 mt-4">
                                                    <label for="exampleInputEmail1">  نوع الحموله  </label>
                                                    <input type="text" class="form-control" name="typeof">
                                                </div>
                                                <div class=" col-md-4 mt-4">
                                                    <label for="exampleInputEmail1">  مكان الحموله  </label>
                                                    <input type="text" class="form-control" name="addof">
                                                </div>
                                            @endif
                                            @if ($typeid == 2)
                                            <div class=" col-md-4 mt-4">
                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> ع 1  </label>
                                                <select name="addtwo" v-model="addtwo"  class="form-control" required>
                                                    <option value="" selected > --حدد --</option>
                                                        <option value="1"> سكر </option>
                                                        <option value="2"> سيراميك </option>
                                                        <option value="3"> مواد غذائيه </option>
                                                </select>
                                            </div>
                                            <div class=" col-md-4 mt-4" v-if="addtwo == 1" >
                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> ع2  </label>
                                                <select name="addthree"  class="form-control" required>
                                                    <option value="" selected > --حدد --</option>
                                                        <option value="1"> سكر </option>
                                                        <option value="2"> جامبو </option>
                                                        <option value="3"> شكاير </option>
                                                </select>
                                            </div>


                                            @endif

                                            <input type="hidden" class="form-control" name="type"
                                                value="{{ $typeid }}">


                                            <div class=" col-12 mt-4">
                                                <button type="button" @click="saveData"
                                                    class="btn btn-primary">حفظ</button>
                                            </div>
                                        </div>


                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-md-nowrap" id="shiping">
                                    <thead>
                                        <tr>
                                            <th> id</th>
                                            <th> رقم الشحنه </th>
                                            <th> النوع </th>
                                            @if ($typeid == 2)
                                            <th> العنوان </th>
                                            <th>2 العنوان </th>
                                            @endif
                                            @if ($typeid == 1)
                                                <th> العميل </th>
                                                <th> نوع الحمولة </th>
                                                <th> مكان الحمولة </th>
                                            @endif
                                            <th> حاله الشحنه </th>
                                            <th> اجرارءات </th>
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
        $(function() {
            var table = $('#shiping').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                
                ajax: {
                    url: "{{ route('shiping.index', $typeid) }}",
                    data: function(d) {

                    }
                },
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                    {
                        data: 'ship_number',
                    },
                    {
                        data: 'parentt',
                    },
                    @if ($typeid == 2)
                    {
                        data: 'addtwo',
                    },
                    {
                        data: 'addthree',
                    },
                    @endif
                    @if ($typeid == 1)
                        {
                            data: 'client_name',
                        },
                        {
                            data: 'typeof',
                        },
                        {
                            data: 'addof',
                        },
                    @endif {
                        data: 'status',
                    },
                    {
                        data: 'action',
                        orderable: true,
                        searchable: true
                    }
                ],
                columnDefs: [{
                targets: 0, // Apply to the first column (index column)
                searchable: false,
                orderable: false
            }]
            });
            $('#shiping tbody').on('click', '.status', function() {
                var value = $(this).attr("value");
                Swal.fire({
                    title: ' هل انت متأكد من تغيير الحاله  ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        data = {
                            '_token': "{{ csrf_token() }}",
                            'id': value,
                        }
                        Swal.showLoading()
                        adawe('{{ route('shiping.changestatus') }}', data)
                        $('#shiping').DataTable().draw();
                    }
                })
                // console.log($(this).attr("value"));
            });
            $('#shiping tbody').on('click', '.delete', function() {
                var value = $(this).attr("value");
                Swal.fire({
                    title: ' هل انت متأكد من  مسح النوع  ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        data = {
                            '_token': "{{ csrf_token() }}",
                            'id': value,
                        }
                        Swal.showLoading()
                        adawe('{{ route('shiping.deleteshiping') }}', data)
                        table.draw();
                    }
                })
                // console.log($(this).attr("value"));
            });
            $('#shiping tbody').on('click', '.print', function() {
                var value = $(this).attr("value");
                Swal.fire({
                    title: '   هل انت متأكد من طباعة         ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'متأكد !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let pdf = "{{ route('reports.shipnumberReport', ':id') }}";
                        pdf = pdf.replace(':id', value);
                        printPdf(pdf);
                    }
                })
                // console.log($(this).attr("value"));
            });
            $('#rule').change(function() {
                table.draw();
            });
            $('#name').keyup(function() {
                table.draw();
            });
            $('#email').keyup(function() {
                table.draw();
            });
            $('#admin_id').change(function() {
                table.draw();
            });
            $('#balance').change(function() {
                table.draw();
            });
        });
        content = new Vue({
            'el': '#content',
            data: {
                parent: false,
                addtwo:"",

                supplier_err: '',
                parent_id: '',
                types: [],
                newarray: [],
                chtypes: [],
                drivers: [],
                type: '',
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
                        $('#shiping').DataTable().draw();
                    }).catch(response => {
                        console.log(response);
                        swal({
                            title: response.response.data.message,
                            type: 'warning',
                            confirmButtonText: 'موافق',
                        });
                        $('#shiping').DataTable().draw();
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

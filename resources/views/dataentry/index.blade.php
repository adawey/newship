@extends('layouts.master')

<title> الموظفين</title>
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الموظفين</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">جدول الموظفين</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table text-md-nowrap" id="employeestable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">اسم الموظف</th>
                                <th class="border-bottom-0"> الايميل </th>
                                <th class="border-bottom-0"> العهده </th>
                                <th class="border-bottom-0"> الحاله </th>
                                <th class="border-bottom-0"> الصلاحيات </th>
                                <th class="border-bottom-0">تعديل / حذف</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Internal Data tables -->
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

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yyyy-mm-dd'
        }).val();
    </script>

    @include('vue')




    <script type="text/javascript">
        $(function() {
            var table = $('#employeestable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('employees.dataentry.index') }}",
                    data: function(d) {}
                },
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {
                        data: 'name',

                    },
                    {
                        data: 'email',

                    },
                    {
                        data: 'balance',

                    },
                    {
                        data: 'status',

                    },
                    {
                        data: 'rolle',
                    },

                    {
                        data: 'action',
                    }

                ]
            });

            $('#employeestable tbody').on('click', '.delete', function() {
                var value = $(this).attr("value");
                Swal.fire({
                    title: ' هل انت متأكد من حذف ',
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
                        helperjs('{{ route('employees.delete') }}', data)
                        $('#employeestable').DataTable().draw();
                    }
                })
                // console.log($(this).attr("value"));
            });
            $('#employeestable tbody').on('click', '.mony', function() {
                let id = $(this).attr("value");
                Swal.fire({
                    title: ' اضافة عهده',
                    html: '<input id="swal-input1" class="swal2-input" type="number">',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: ' اضافة',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        data = {
                            '_token': "{{ csrf_token() }}",
                            'id': id,
                            'amount': document.getElementById('swal-input1').value,
                        }
                        Swal.showLoading()
                        axios.post('{{ route('employees.dataentry.addbalance') }}', data).then(response => {
                            if (response.status !== 200) {
                                console.log(response)
                            } else {
                                console.log(response);
                                if (response.data.err == true) {
                                    swal({
                                        title: response.data.msg || response
                                            .data.message || "Default title",
                                        type: 'warning',
                                        confirmButtonText: 'موافق',
                                    });
                                } else {
                                    let value = response.data.id;
                                    let pdf = "{{ route('reports.printrec', ':id') }}";
                                        pdf = pdf.replace(':id', value);
                                        printPdf(pdf);
                                    swal({
                                        title: response.data.msg || response
                                            .data.message || "Default title",
                                        type: 'success',
                                        confirmButtonText: 'موافق',
                                    });

                                }
                            }
                        }).catch(response => {
                            console.log(response)
                        })

                        $('#employeestable').DataTable().draw();
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            });
            $('#employeestable tbody').on('click', '.status', function() {
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
                        adawe('{{ route('employees.dataentry.status') }}', data)
                        $('#employeestable').DataTable().draw();
                    }
                })
                // console.log($(this).attr("value"));
            });
        });
    </script>
@endsection

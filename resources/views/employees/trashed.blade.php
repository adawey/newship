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
            {{-- <form method="get" action="{{ route('employees.exportemployee') }}" enctype="multipart/form-data">
                @csrf
                <div class="row p-3">

                    <div class="col-lg-4 mt-2">
                        <p class="mt-0"> الاسم </p>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="col-lg-4 mt-2">
                        <p class="mt-0"> الايميل </p>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="col-lg-4 mt-2">
                        <p class="mt-0"> رقم الجوال </p>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-lg btn-block"> تصدير </button>
                    </div>
                </div>
            </form> --}}




            <div class="card-body">
                <div class="table-responsive">

                    <table class="table text-md-nowrap" id="employeestable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0"> ID </th>
                                <th class="border-bottom-0">اسم الموظف</th>
                                <th class="border-bottom-0"> الايميل </th>
                                <th class="border-bottom-0"> جوال </th>
                                <th class="border-bottom-0">العنوان</th>
                                {{-- <th class="border-bottom-0"> بواسطة </th> --}}
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

    <!-- Large Modal -->
    <div class="modal" id="modaldemo3">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">موظف جديد</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employees.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم الموظف</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> الايميل </label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> الباسوورد </label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الدور</label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option value="" selected disabled> --حدد الدور--</option>
                                {{-- @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>


                        <div class="form-group">
                            <label>تاريخ التعين</label>
                            <input class="form-control fc-datepicker" name="hiring_date" placeholder="YYYY-MM-DD"
                                type="date" value="" required>
                        </div>

                        <div class="form-group">
                            <label>تاريخ الميلاد</label>
                            <input class="form-control fc-datepicker" name="birth_date" placeholder="YYYY-MM-DD"
                                type="date" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الرقم القومي</label>
                            <input type="text" class="form-control" id="nationalId" name="nationalId">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">التليفون</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الملاحظات</label>
                            <input type="text" class="form-control" id="notes" name="notes">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--End Large Modal -->
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
                    url: "{{ route('employees.trashed') }}",
                    data: function(d) {}
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name',

                    },
                    {
                        data: 'email',

                    },

                    {
                        data: 'phone',

                    },
                    {
                        data: 'location'
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
            $('#employeestable tbody').on('click', '.delete', function() {
                var value = $(this).attr("value");
                Swal.fire({
                    title: ' هل انت متأكد من الحذف ',
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
                        helperjs('{{ route('employees.destroy') }}', data)
                        $('#employeestable').DataTable().draw();
                    }
                })
                // console.log($(this).attr("value"));
            });
            $('#employeestable tbody').on('click', '.restart', function() {
                var value = $(this).attr("value");
                Swal.fire({
                    title: ' هل انت متأكد من الاستعاده  ',
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
                        helperjs('{{ route('employees.restore') }}', data)
                        $('#employeestable').DataTable().draw();
                    }
                })
                // console.log($(this).attr("value"));
            });

        });
    </script>
@endsection

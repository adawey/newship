@extends('layouts.master')
<title> الصفحة الرئيسية </title>
@section('css')
    <!-- Internal fullcalendar Css-->
    <link href="{{ URL::asset('assets/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الصفحة الرئيسية</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div id='content'>

        {{-- @foreach ($shippingDetails as $type => $details)
            <h1>{{ $type->name ?? '' }} ffffff</h1>

            @php
                $filteredDetails = $details->filter(function ($detail) {
                    return is_null($detail->decharge_date);
                });
                // Sum the desired field, if you want to sum by any particular field
                $sum = $filteredDetails->sum('due'); // Replace 'some_field' with the column you want to sum
            @endphp
            عهده : {{ $sum }}

            @foreach ($details as $detail)
                {{ $detail->id }} <br>
            @endforeach
        @endforeach --}}

        @include('cards.homecard')
        <!-- row closed -->

    </div>
    <!-- Container closed -->


    <!-- main-content closed -->
@endsection
@section('js')
    <!-- moomet min js -->
    <script src="{{ URL::asset('assets/plugins/moment/min/moment.min.js') }}"></script>
    <!--Internal  Date picker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  Fullcalendar js -->
    <script src="{{ URL::asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
    <!-- Internal Select2.full.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!--Internal App calendar js -->
    <script>
        var azCalendar;
    </script>
    <script src="{{ URL::asset('assets/js/app-calendar.js') }}"></script>
    @include('vue');
    <script>
        // sample calendar events data
        'use strict'
        var curYear = moment().format('YYYY');
        var curMonth = moment().format('MM');
        // Calendar Event Source

        var azCalendarEvents = {
            id: 1,
            events: []
        }
        // Birthday Events Source
        var azBirthdayEvents = {
            id: 2,
            // backgroundColor: '#3bb001',
            // borderColor: '#3bb001',
            // textColor: '#fff',
            events: []
        };
        var azHolidayEvents = {
            id: 3,
            // backgroundColor: '#f10075',
            // borderColor: '#f10075',
            // textColor: '#fff',
            events: []
        };
        var azOtherEvents = {
            id: 4,
            backgroundColor: '#ffb52b',
            borderColor: '#ffb52b',
            textColor: '#fff',
            events: []
        };
    </script>


    <script>
        home = new Vue({
            'el': '#content',
            'data': {
                'testevents': [],
                'counts': [],
                'test2': ''
            },
            methods: {
                change: function() {
                    azCalendarEvents.events = this.testevents;
                },
                togel: function(id) {

                    e.preventDefault();
                    // // azCalendar.removeEventSource(2);
                    // azCalendar.addEventSource(azBirthdayEvents);
                    // azCalendar.render();
                },
                getData: function() {
                    let formData = new FormData(document.getElementById('home'));
                    axios.post('{{ route('driver.json') }}', formData).then(response => {
                        if (response.data.err == true) {
                            swal({
                                title: response.data.msg,
                                type: 'warning',
                                confirmButtonText: 'موافق',
                            });
                        } else {
                            this.counts = response.data.count;
                            azCalendarEvents.events = response.data.events;
                            azBirthdayEvents.events = response.data.delivery_date_ev;
                            azHolidayEvents.events = response.data.receipt_date_ev;
                            azCalendar.addEventSource(azCalendarEvents);
                            azCalendar.addEventSource(azBirthdayEvents);
                            azCalendar.addEventSource(azHolidayEvents);
                            azCalendar.removeEventSource(1);
                            azCalendar.removeEventSource(2);
                            azCalendar.removeEventSource(3);
                            azCalendar.render();
                        }
                    }).catch(response => {
                        console.log(response);
                    })
                    // this.CustomBranch();
                },

            },
            created() {
                // this.Branch();
                // this.getData();
            },



        })



        // $( "#tester" ).on( "click", function() {
        //     // console.log( $( this ).text() );
        //     azCalendarEvents.events = testevents;
        //     console.log(azCalendarEvents)
        // });
    </script>
@endsection

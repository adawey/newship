<html dir="rtl" lang="ar">

<head>
    {{-- <title> تقرير برقم العربيه </title> --}}
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ URL::asset('assets/pdf/one.css') }}" rel="stylesheet">
    <style>
        @media print {
            @page {
                size: landscape;
            }
        }

        .logo {
            max-width: 100%;
            max-height: 50px;
        }
    </style>
</head>

<body>




    <table class="table table-border">
        <tbody>
            @if ($invs->count() > 0)
                <tr>
                    <th> </th>
                    <th> نوع الشحنه </th>
                    <th> اسم السائق </th>
                    <th> رقم السياره </th>
                    <th> رقم المقطوره </th>
                    <th> تاريخ الوصول </th>
                    @if ($invs[0]->type_id == 1)
                        <th> تاريخ التحميل </th>
                        <th> فرق التحميل </th>
                    @endif
                    <th> فرق الوصول </th>
                    <th> تاريخ التعتيق </th>
                    <th> النولون </th>
                    @if ($invs[0]->type_id !== 3)
                        <th> تحميل </th>
                    @else
                        <th> طلعه </th>
                    @endif
                    @if ($invs[0]->type_id !== 3)
                        <th> طرق </th>
                        <th> بسكول ميزان </th>
                        <th> معديه </th>
                    @endif
                    @if ($invs[0]->type_id == 2)
                        <th> رسوم ميزان </th>
                    @endif
                    @if ($invs[0]->type_id !== 2)
                        <th> تحويله </th>
                    @endif
                    @if ($invs[0]->type_id !== 3)
                        <th> الشرائح </th>
                        <th> محافظه </th>
                        <th> باب المينا </th>
                    @endif


                    @if ($invs[0]->type_id !== 1)
                        <th> دخول </th>
                        <th> مبيت </th>
                        <th> مبيت هيئه</th>
                    @endif
                    {{-- // لو الشحنه رفح  --}}
                    @if ($invs[0]->type_id == 1)
                        <th> مبيت الوصول </th>
                        {{-- <th> رسوم ميزان </th> --}}
                        <th> حفر </th>
                    @endif
                    {{-- // لو الشحنه غاز  --}}
                    @if ($invs[0]->type_id == 3)
                        <th> شعاع </th>
                        <th> تحميل تنكات </th>
                        <th> شريحه فارغ </th>
                        <th> شريحه محمل </th>
                        <th> معديه فارغ </th>
                        <th> معديه محمل </th>
                        <th> رسوم ميزان </th>
                        <th> حراسه </th>
                    @endif
                    @if ($invs[0]->type_id == 1)
                        <th> مبيت السائق </th>
                    @endif
                    <th> اجمالي الشركة </th>
                    @if ($invs[0]->type_id !== 1)
                        <th> مبيت هيئة المندوب </th>
                    @endif
                    @if ($invs[0]->type_id == 1)
                        <th> اجمالي السائق </th>
                        <th> العهده </th>
                        <th> سلفه </th>
                        <th> الصافي </th>
                    @else
                        <th> العهده </th>
                        <th> سلفه </th>
                        <th> اجمالي السائق </th>
                    @endif
                    {{-- <th> اجمالي الدفعات </th> --}}
                </tr>

                @foreach ($invs as $d)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td>{{ $d->mainship->typ->name ?? ' ' }}</td>
                        <td>{{ $d->driv->name ?? ' ' }}</td>
                        <td>{{ $d->car_number ?? ' ' }}</td>
                        <td>{{ $d->trailer_number ?? ' ' }}</td>
                        <td>{{ $d->charge_date ?? ' ' }}</td>
                        @if ($d->type_id == 1)
                            <td>{{ $d->charge_datetwo ?? ' ' }}</td>
                            <td>{{ $d->tahmel_between ?? ' ' }}</td>
                        @endif
                        <td>{{ $d->charge_between ?? ' ' }}</td>
                        <td>{{ $d->decharge_date ?? ' ' }}</td>
                        <td>{{ $d->nolon ?? ' ' }}</td>
                        <td>{{ $d->tax ?? ' ' }}</td>
                        @if ($d->type_id !== 3)
                            <td>{{ $d->karta ?? ' ' }}</td>
                            <td>{{ $d->mizan ?? ' ' }}</td>
                            <td>{{ $d->kobry ?? ' ' }}</td>
                        @endif
                        @if ($d->type_id == 2)
                            <td>{{ $d->balance_fees ?? ' ' }}</td>
                        @endif
                        @if ($d->type_id !== 2)
                            <td>{{ $d->transfar ?? ' ' }}</td>
                        @endif
                        @if ($d->type_id !== 3)
                            <td>{{ $d->leaval ?? ' ' }}</td>
                            <td>{{ $d->goverment ?? ' ' }}</td>
                            <td>{{ $d->enamel_door ?? ' ' }}</td>
                        @endif


                        @if ($d->type_id !== 1)
                            <td>{{ $d->entry ?? ' ' }}</td>
                            <td>{{ $d->overnight ?? ' ' }}</td>
                            <td>{{ $d->overnight2 ?? ' ' }}</td>
                        @endif
                        @if ($d->type_id == 1)
                            <td>{{ $d->overnight ?? ' ' }}</td>
                            {{-- <td>{{ $d->balance_fees ?? ' ' }}</td> --}}
                            <td>{{ $d->digging ?? ' ' }}</td>
                        @endif
                        @if ($d->type_id == 3)
                            <td>{{ $d->shoaa ?? ' ' }}</td>
                            <td>{{ $d->tankat ?? ' ' }}</td>
                            <td>{{ $d->blank_slice ?? ' ' }}</td>
                            <td>{{ $d->full_slice ?? ' ' }}</td>
                            <td>{{ $d->slice_kopry ?? ' ' }}</td>
                            <td>{{ $d->full_kopry ?? ' ' }}</td>
                            <td>{{ $d->balance_fees ?? ' ' }}</td>
                            <td>{{ $d->gard ?? ' ' }}</td>
                        @endif
                        @if ($d->type_id == 1)
                            <td>{{ $d->overnightdriv ?? ' ' }}</td>
                        @endif
                        <td>{{ $d->totalone ?? ' ' }}</td>
                        {{-- لو مش رفح  --}}
                        @if ($d->type_id !== 1)
                            <td>{{ $d->accommodation ?? ' ' }}</td>
                        @endif
                        @if ($d->type_id == 1)
                            {{-- <th> اجمالي السائق </th>
                        <th> العهده </th>
                        <th> سلفه </th>
                        <th> الصافي </th> --}}
                            <td>{{ $d->drivermony ?? ' ' }}</td>
                            <td>{{ $d->covenant ?? ' ' }}</td>
                            <td>{{ $d->discount ?? ' ' }}</td>
                            <td>{{ $d->due ?? ' ' }}</td>
                        @else
                            <td>{{ $d->covenant ?? ' ' }}</td>
                            <td>{{ $d->discount ?? ' ' }}</td>
                            <td>{{ $d->due ?? ' ' }}</td>
                            {{-- <th> العهده </th>
                        <th> سلفه </th>
                        <th> اجمالي السائق </th> --}}
                        @endif


                        {{-- <td @if ($d->totalpayment - $d->due == 0) bgcolor="green" @endif>{{ $d->totalpayment ?? ' ' }}
                        </td> --}}

                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    @if ($d->type_id == 1)
                        <td></td>
                        <td></td>
                    @endif
                    <td></td>
                    <td></td>
                    <td>{{ $invs->sum('nolon') }}</td>
                    <td>{{ $invs->sum('tax') }}</td>
                    @if ($invs[0]->type_id !== 3)
                        <td>{{ $invs->sum('karta') }}</td>
                        <td>{{ $invs->sum('mizan') }}</td>
                        <td>{{ $invs->sum('kobry') }}</td>
                    @endif
                    @if ($invs[0]->type_id == 2)
                        <td>{{ $invs->sum('balance_fees') }}</td>
                    @endif
                    @if ($invs[0]->type_id !== 2)
                        <td>{{ $invs->sum('transfar') }}</td>
                    @endif
                    {{-- لو رفح  --}}
                    @if ($invs[0]->type_id !== 3)
                        <td>{{ $invs->sum('leaval') }}</td>
                        <td>{{ $invs->sum('goverment') }}</td>
                        <td>{{ $invs->sum('enamel_door') }}</td>
                    @endif
                    @if ($invs[0]->type_id !== 1)
                        <td>{{ $invs->sum('entry') }}</td>
                        <td>{{ $invs->sum('overnight') }}</td>
                        <td>{{ $invs->sum('overnight2') }}</td>
                    @endif
                    {{-- لو رفح  --}}
                    @if ($invs[0]->type_id == 1)
                        <td>{{ $invs->sum('overnight') }}</td>
                        {{-- <td>{{ $invs->sum('balance_fees') }}</td> --}}
                        <td>{{ $invs->sum('digging') }}</td>
                    @endif
                    @if ($invs[0]->type_id == 3)
                        <td>{{ $invs->sum('shoaa') }}</td>
                        <td>{{ $invs->sum('tankat') }}</td>
                        <td>{{ $invs->sum('blank_slice') }}</td>
                        <td>{{ $invs->sum('full_slice') }}</td>
                        <td>{{ $invs->sum('slice_kopry') }}</td>
                        <td>{{ $invs->sum('full_kopry') }}</td>
                        <td>{{ $invs->sum('balance_fees') }}</td>
                        <td>{{ $invs->sum('gard') }}</td>
                    @endif

                    @if ($invs[0]->type_id == 1)
                        <td>{{ $invs->sum('overnightdriv') }}</td>
                    @endif
                    <td>{{ $invs->sum('totalone') }}</td>
                    {{-- لو  مش رفح  --}}
                    @if ($invs[0]->type_id !== 1)
                        <td>{{ $invs->sum('accommodation') }}</td>
                    @endif
                    @if ($d->type_id == 1)
                        {{-- <th> اجمالي السائق </th>
                <th> العهده </th>
                <th> سلفه </th>
                <th> الصافي </th> --}}
                        <td>{{ $invs->sum('drivermony') }}</td>
                        <td>{{ $invs->sum('covenant') }}</td>
                        <td>{{ $invs->sum('discount') }}</td>
                        <td>{{ $invs->sum('due') }}</td>
                    @else
                        <td>{{ $invs->sum('covenant') }}</td>
                        <td>{{ $invs->sum('discount') }}</td>
                        <td>{{ $invs->sum('due') }}</td>
                        {{-- <th> العهده </th>
                <th> سلفه </th>
                <th> اجمالي السائق </th> --}}
                    @endif


                    {{-- <td>{{ $invs->sum('totalpayment') }}</td> --}}
                </tr>
            @endif
        </tbody>
    </table>



    {{-- <script>
        function printPdf(pdf) {

            var iframe = document.createElement('iframe');
            iframe.style.display = "none";
            iframe.src = pdf;

            document.body.appendChild(iframe);
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        }
    </script> --}}
</body>

</html>

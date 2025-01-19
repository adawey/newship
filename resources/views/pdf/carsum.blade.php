<html dir="rtl" lang="ar">

<head>
    <title> تقرير برقم العربيه </title>
    <meta charset="utf-8">

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
        @if ($invs->count() > 0)
            <tbody>
                <tr>
                    <td></td>
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
                        <th> رسوم ميزان </th>
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
                        <th> حراسه </th>
                    @endif
                    <th> اجمالي الشركة </th>
                    <th> مبيت هيئة المندوب </th>
                    <th> العهده </th>
                    <th> سلفه </th>
                    <th> اجمالي السائق </th>
                    <th> اجمالي الدفعات </th>
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
                            {{-- <td>{{ $d->mizan ?? ' ' }}</td> --}}
                            <td>{{ $d->kobry ?? ' ' }}</td>
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
                            <td>{{ $d->balance_fees ?? ' ' }}</td>
                            <td>{{ $d->digging ?? ' ' }}</td>
                        @endif
                        @if ($d->type_id == 3)
                            <td>{{ $d->shoaa ?? ' ' }}</td>
                            <td>{{ $d->tankat ?? ' ' }}</td>
                            <td>{{ $d->blank_slice ?? ' ' }}</td>
                            <td>{{ $d->full_slice ?? ' ' }}</td>
                            <td>{{ $d->slice_kopry ?? ' ' }}</td>
                            <td>{{ $d->full_kopry ?? ' ' }}</td>
                            <td>{{ $d->entrance_fees ?? ' ' }}</td>
                            <td>{{ $d->gard ?? ' ' }}</td>
                        @endif
                        <td>{{ $d->totalone ?? ' ' }}</td>
                        <td>{{ $d->accommodation ?? ' ' }}</td>
                        <td>{{ $d->covenant ?? ' ' }}</td>
                        <td>{{ $d->discount ?? ' ' }}</td>
                        <td>{{ $d->due ?? ' ' }}</td>
                        <td @if ($d->totalpayment - $d->due == 0) bgcolor="green" @endif>{{ $d->totalpayment ?? ' ' }}
                        </td>
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
                        {{-- <td>{{ $invs->sum('mizan') }}</td> --}}
                        <td>{{ $invs->sum('kobry') }}</td>
                    @endif
                    @if ($invs[0]->type_id !== 2)
                        <td>{{ $invs->sum('transfar') }}</td>
                    @endif
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
                    @if ($invs[0]->type_id == 1)
                        <td>{{ $invs->sum('balance_fees') }}</td>
                        <td>{{ $invs->sum('digging') }}</td>
                    @endif
                    @if ($invs[0]->type_id == 3)
                    <td>{{ $invs->sum('shoaa') }}</td>
                    <td>{{ $invs->sum('tankat') }}</td>
                    <td>{{ $invs->sum('blank_slice') }}</td>
                    <td>{{ $invs->sum('full_slice') }}</td>
                    <td>{{ $invs->sum('slice_kopry') }}</td>
                    <td>{{ $invs->sum('full_kopry') }}</td>
                    <td>{{ $invs->sum('entrance_fees') }}</td>
                    <td>{{ $invs->sum('gard') }}</td>
                    @endif
                    <td>{{ $invs->sum('totalone') }}</td>
                    <td>{{ $invs->sum('accommodation') }}</td>
                    <td>{{ $invs->sum('covenant') }}</td>
                    <td>{{ $invs->sum('discount') }}</td>
                    <td>{{ $invs->sum('due') }}</td>
                    <td>{{ $invs->sum('totalpayment') }}</td>
                </tr>

            </tbody>
        @endif
    </table>
    {{-- <table class="table table-border">
        @if ($invs->count() > 0)
            <tbody>
                <tr>
                    <th> المجموع </th>
                </tr>
                <tr>
                    <td> {{ $invs->sum('residual') }} </td>
                </tr>
            </tbody>
        @endif
    </table> --}}
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

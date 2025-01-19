<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th> النوع </th>
            <th> المبلغ </th>
            <th> السائق  </th>
            <th> رقم الشحنه   </th>
            <th>  التاريخ    </th>
        </tr>
        @foreach ($invs as $d)
            <tr>
                <td @if($d->typepay == "add") bgcolor="green" @else  bgcolor="red" @endif > @if($d->typepay == "add") اضافة @else دفع لسائق @endif </td>
                <td> {{ $d->amount }} </td>
                <td> @if($d->typepay !== "add") {{ $d->branch->driv->name ?? "" }} @endif </td>
                <td> @if($d->typepay !== "add") {{ $d->branch->ship_num ?? "" }} @endif </td>
                <td> {{ $d->created_at ?? "" }}  </td>
            </tr>
        @endforeach
    </table>
</body>

</html>

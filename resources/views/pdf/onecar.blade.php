<html dir="rtl" lang="ar">
<head>
    <title>   كوبون </title>
    <meta charset="utf-8">

    {{-- <link href="{{URL::asset('assets/pdf/one.css')}}" rel="stylesheet"> --}}
    <style>

        .logo{
            max-width: 100%;
            max-height: 50px;
        }
        
    </style>
</head>
<body>


   <form class="form" style="max-width: none; width: 1005px;">
    <h3 style="text-align: center"> <img class='logo' src="" /></h3>
    <p style="font-size: large;text-align: center ">
                
    </p>
    <table class="table table-border">
        <tbody>
            <tr>
                <th>  اسم السائق </th>
                <th>  رقم العربيه    </th>
                <th>  رقم المقطوره  </th>
                <th>  نولون  </th>
                <th>  كارته </th>
            </tr>
			<tr>
                <td>{{$data->driv->name ?? " "}}</td>
                <td>{{$data->car_number ?? " "}}</td>
                <td>{{$data->trailer_number ?? " "}}</td>
                <td>{{$data->nolon ?? " "}}</td>
                <td>{{$data->karta ?? " "}}</td>
            
            </tr>
        </tbody>
    </table>
</form>


<script>
function printPdf(pdf) {

var iframe = document.createElement('iframe');
iframe.style.display = "none";
iframe.src = pdf;

document.body.appendChild(iframe);
iframe.contentWindow.focus();
iframe.contentWindow.print();
}
</script>
</body>

</html>


<html dir="rtl" lang="ar">
    <head>
        <title>   ..... </title>
        <meta charset="utf-8">

       
    </head>

     {{-- <head>
         <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
     </head> --}}

     <style>
 body{
     font-size: 15px;
     text-align: center;
     margin: 0 20%;
 }
 table {
     font-family: arial, sans-serif;
     border-collapse: collapse;
     width: 100%;
     text-align: center;
     direction: rtl;
   }

   td, th {
     text-align: right;
     padding: 8px;
     text-align: center;
   }
   .loli{
     margin: 0 25%;  }
    .title{
        text-align:right;
        display:block;
    }
    .logo{
        height: 70px;
        width: 70px;

        text-align:right;

    }
 </style>
     <body>
        <span class='title'>  .....  </span>
         <span class='title'>    ...  </span>
         <div class="loli">
             <h1>إيصال استلام نقدية </h1>
         </div>
         <table>
             <tr>
                 <td> اسم الموظف :</td>
                 <td>   {{$pay->vendor->name }}    </td>
             </tr>
             <tr>
                 <td> التاريخ :</td>
                 <td>  {{$pay->created_at }} </td>
             </tr>
             <tr>
                 <td>  المبلغ  :</td>
                 <td> {{$pay->amount }} ج </td>
             </tr>
             <tr>
                 <td>  المسئول : </td>
                 <td>  {{$pay->leader->name }}     </td>
             </tr>
         </table>

         <table >
             <thead class='mt-5'>
                 <tr>
                   <th scope="col">   </th>
                   <th scope="col"> التوقيع </th>
                 </tr>
                 <tr>
                    <th scope="col">   </th>
                    <th scope="col"> ..................... </th>
                  </tr>
             </thead>
             <tbody>

                 <tr>
                     <td></td>

                 </tr>

             </tbody>

         </table>
             <hr>
             <footer>
                  أتفهم بأنه عندما اوقع فأنى اقر بأنى استلمت المبلغ المكتوب اعلاه صحيحا وكاملا
                 <br>
             </footer>
     </body>
 </html>

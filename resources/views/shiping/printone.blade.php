<html dir="rtl" lang="ar">

<head>
    <title> كوبون </title>
    <meta charset="utf-8">

    {{-- <link href="{{URL::asset('assets/pdf/one.css')}}" rel="stylesheet"> --}}
    <style>
        .logo {
            max-width: 100%;
            max-height: 50px;
        }

        form {
            margin-top: 35px;
        }

        label {
            line-height: 100%;
            margin-bottom: 5px;
            font-size: 14px;
        }

        input {
            background-color: transparent;
            width: 100%;
            height: 37px;
            margin-bottom: 20px;
            padding: 0 8px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 5px;
        }

        .bigdiv {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-content: space-around;
            align-items: center;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .div {
            width: 32%;
            display: inline block;
        }
    </style>
</head>

<body>


    <form class="form" style="max-width: none; width: 90%;">
        <h3 style="text-align: center"> <img class='logo' src="" /></h3>
        <p style="font-size: large;text-align: center ">
        <form class="signup-form">
            
            <div class="bigdiv">
                <div class="div">
                    <label for="signup-name"> اسم السائق </label>
                    <input id="signup-name" type="text" value="{{ $data->driv->name ?? ' ' }}" autocomplete="off" />
                </div>
                <div class="div">
                    <label for="signup-name"> رقم السياره </label>
                    <input id="signup-name" type="text" value="{{ $data->car_number ?? ' ' }}" autocomplete="off" />
                </div>
                <div class="div">
                    <label for="signup-name"> رقم المقطوره </label>
                    <input id="signup-name" type="text" value="{{ $data->trailer_number ?? ' ' }}"
                        autocomplete="off" />
                </div>
                <div class="div">
                    <label for="signup-name"> تاريخ الوصول </label>
                    <input id="signup-name" type="date" value="{{ $data->charge_date ?? ' ' }}" autocomplete="off" />
                </div>
                {{-- @if ($data->type_id == 1)
                    <div class="div">
                        <label for="signup-name"> تاريخ التحميل </label>
                        <input id="signup-name" type="date" value="{{ $data->charge_datetwo ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> فرق التحميل </label>
                        <input id="signup-name" type="text" value="{{ $data->tahmel_between ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                @endif --}}

                <div class="div">
                    <label for="signup-name"> فرق الوصول </label>
                    <input id="signup-name" type="text" value="{{ $data->charge_between ?? ' ' }}"
                        autocomplete="off" />
                </div>
                <div class="div">
                    <label for="signup-name"> تاريخ التعتيق </label>
                    <input id="signup-name" type="date" value="{{ $data->decharge_date ?? ' ' }}"
                        autocomplete="off" />
                </div>
                <div class="div">
                    <label for="signup-name"> نولون </label>
                    <input id="signup-name" type="text" value="{{ $data->nolon ?? ' ' }}" autocomplete="off" />
                </div>
                <div class="div">
                    @if ($data->type_id !== 3)
                        <label for="signup-name"> تحميل </label>
                    @else
                        <label for="signup-name"> طلعه </label>
                    @endif
                    <input id="signup-name" type="text" value="{{ $data->tax ?? ' ' }}" autocomplete="off" />
                </div>
                @if ($data->type_id !== 3)
                    <div class="div">
                        <label for="signup-name"> طرق </label>
                        <input id="signup-name" type="text" value="{{ $data->karta ?? ' ' }}" autocomplete="off" />
                    </div>
                    {{-- <div class="div">
                    <label for="signup-name"> بسكول ميزان </label>
                    <input id="signup-name" type="text" value="{{ $data->charge_date ?? ' ' }}" autocomplete="off" />
                </div> --}}
                    <div class="div">
                        <label for="signup-name"> معديه </label>
                        <input id="signup-name" type="text" value="{{ $data->kobry ?? ' ' }}" autocomplete="off" />
                    </div>
                @endif
                @if ($data->type_id !== 2)
                    <div class="div">
                        <label for="signup-name"> تحويله </label>
                        <input id="signup-name" type="text" value="{{ $data->transfar ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                @endif
                @if ($data->type_id !== 3)
                   
                    <div class="div">
                        <label for="signup-name"> الشرائح </label>
                        <input id="signup-name" type="text" value="{{ $data->leaval ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> محافظه </label>
                        <input id="signup-name" type="text" value="{{ $data->goverment ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> باب المينا </label>
                        <input id="signup-name" type="text" value="{{ $data->enamel_door ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                @endif
                <div class="div">
                    <label for="signup-name"> مبيت الوصول </label>
                    <input id="signup-name" type="text" value="{{ $data->overnight ?? ' ' }}"
                        autocomplete="off" />
                </div>
                @if ($data->type_id !== 1)
                <div class="div">
                    <label for="signup-name"> رسوم ميزان </label>
                    <input id="signup-name" type="text" value="{{ $data->balance_fees ?? ' ' }}"
                        autocomplete="off" />
                </div>
                    <div class="div">
                        <label for="signup-name"> دخول </label>
                        <input id="signup-name" type="text" value="{{ $data->entry ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> مبيت هيئه </label>
                        <input id="signup-name" type="text" value="{{ $data->overnight2 ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                @endif
                @if ($data->type_id == 1)
                    <div class="div">
                        <label for="signup-name"> حفر </label>
                        <input id="signup-name" type="text" value="{{ $data->digging ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> ميزان بسكول </label>
                        <input id="signup-name" type="text" value="{{ $data->mizan ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    {{-- <div class="div">
                        <label for="signup-name"> مبيت سائق </label>
                        <input id="signup-name" type="text" value="{{ $data->overnightdriv ?? ' ' }}"
                            autocomplete="off" />
                    </div> --}}
                @endif
                @if ($data->type_id == 3)
                    <div class="div">
                        <label for="signup-name"> شعاع </label>
                        <input id="signup-name" type="text" value="{{ $data->shoaa ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> تحميل تنكات </label>
                        <input id="signup-name" type="text" value="{{ $data->tankat ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> شريحه فارغ </label>
                        <input id="signup-name" type="text" value="{{ $data->blank_slice ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> شريحه محمل </label>
                        <input id="signup-name" type="text" value="{{ $data->full_slice ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> معديه فارغ </label>
                        <input id="signup-name" type="text" value="{{ $data->slice_kopry ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    <div class="div">
                        <label for="signup-name"> معديه محمل </label>
                        <input id="signup-name" type="text" value="{{ $data->full_kopry ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                    {{-- <div class="div">
                        <label for="signup-name"> رسم ميزان </label>
                        <input id="signup-name" type="text" value="{{ $data->entrance_fees ?? ' ' }}"
                            autocomplete="off" />
                    </div> --}}
                    <div class="div">
                        <label for="signup-name"> حراسه </label>
                        <input id="signup-name" type="text" value="{{ $data->gard ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                @endif
                <div class="div">
                    <label for="signup-name"> اجمالي الشركه </label>
                    <input id="signup-name" type="text" value="{{ $data->totalone ?? ' ' }}"
                        autocomplete="off" />
                </div>
                {{-- <div class="div">
                    <label for="signup-name"> اجمالي السائق </label>
                    <input id="signup-name" type="text" value="{{ $data->drivermony ?? ' ' }}"
                        autocomplete="off" />
                </div>
                @if ($data->type_id !== 1)
                    <div class="div">
                        <label for="signup-name"> مبيت هيئة المندوب </label>
                        <input id="signup-name" type="text" value="{{ $data->accommodation ?? ' ' }}"
                            autocomplete="off" />
                    </div>
                @endif

                <div class="div">
                    <label for="signup-name"> العهده </label>
                    <input id="signup-name" type="text" value="{{ $data->covenant ?? ' ' }}"
                        autocomplete="off" />
                </div>
                <div class="div">
                    <label for="signup-name"> سلفه </label>
                    <input id="signup-name" type="text" value="{{ $data->discount ?? ' ' }}"
                        autocomplete="off" />
                </div>
                <div class="div">
                    <label for="signup-name"> الصافي </label>
                    <input id="signup-name" type="text" value="{{ $data->due ?? ' ' }}" autocomplete="off" />
                </div> --}}
            </div>



        </form>
        </p>
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

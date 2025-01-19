<script>
    $('#driver_idd').on('select2:select', function(e) {
        var data = e.params.data;
        console.log(data);
    });
    $(function() {

        var table = $('#shiping').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('shiping.enterDriver', $shiping->id) }}",
                data: function(d) {
                    d.driver_id = $('#driver_id').val(),
                        d.car_number = $('#car_number').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'driver',
                },
                {
                    data: 'car_number',
                },
                {
                    data: 'trailer_number',
                },
                {
                    data: 'charge_date',
                },
                @if ($shiping->type == 1)
                    {
                        data: 'charge_datetwo',
                    },
                @endif {
                    data: 'charge_between',
                },
                {
                    data: 'decharge_date',
                },
                {
                    data: 'totalone',
                },
                {
                    data: 'covenant',
                },
                {
                    data: 'discount',
                },
                {
                    data: 'due',
                },
                {
                    data: 'drivermony',
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
        $('#shiping tbody').on('click', '.info', function() {
            var value = $(this).attr("value");
            data = {
                '_token': "{{ csrf_token() }}",
                'id': value,
            }
            axios.post('{{ route('shiping.info') }}', data).then(response => {
                if (response.data.err == true) {
                    swal({
                        title: 'هناك خطأ ما غير متوقع',
                        type: 'warning',
                        confirmButtonText: 'موافق',
                    });
                } else {
                    content.data = response.data.data

                }
            }).catch(response => {
                swal({
                    title: 'هناك خطأ ما غير متوقع',
                    type: 'warning',
                    confirmButtonText: 'موافق',
                });
            })
            // console.log($(this).attr("value"));
        });
        $('#shiping tbody').on('click', '.payment', function() {
            var value = $(this).attr("value");
            data = {
                '_token': "{{ csrf_token() }}",
                'id': value,
            }
            axios.post('{{ route('shiping.infopay') }}', data).then(response => {
                if (response.data.err == true) {
                    swal({
                        title: 'هناك خطأ ما غير متوقع',
                        type: 'warning',
                        confirmButtonText: 'موافق',
                    });
                } else {
                    content.data = response.data.data
                    content.amountpay = response.data.payments
                    content.nm = content.data.due - content.amountpay
                }
            }).catch(response => {
                swal({
                    title: 'هناك خطأ ما غير متوقع',
                    type: 'warning',
                    confirmButtonText: 'موافق',
                });
            })
            // console.log($(this).attr("value"));
        });
        $('#shiping tbody').on('click', '.delete', function() {
            var value = $(this).attr("value");
            Swal.fire({
                title: ' هل انت متأكد من  مسح السائق  ',
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
                    adawe('{{ route('shiping.delete') }}', data)
                    table.draw();
                }
            })
            // console.log($(this).attr("value"));
        });
        $('#shiping tbody').on('click', '.print', function() {
            var value = $(this).attr("value");
            Swal.fire({
                title: '   طباعة تقرير الشركة             ',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'متأكد !'
            }).then((result) => {
                if (result.isConfirmed) {
                    let pdf = "{{ route('shiping.printforcompany', ':id') }}";
                    pdf = pdf.replace(':id', value);
                    printPdf(pdf);
                }
            })
            // console.log($(this).attr("value"));
        });
        $('#shiping tbody').on('click', '.print2', function() {
            var value = $(this).attr("value");
            Swal.fire({
                title: '   طباعة تقرير السائق             ',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'متأكد !'
            }).then((result) => {
                if (result.isConfirmed) {
                    let pdf = "{{ route('shiping.printfordriver', ':id') }}";
                    pdf = pdf.replace(':id', value);
                    printPdf(pdf);
                }
            })
            // console.log($(this).attr("value"));
        });
        $('#shiping tbody').on('click', '.edit', function() {
            var value = $(this).attr("value");
            content.editdrive = value
            content.getedit()
            // console.log($(this).attr("value"));
        });
        $('#driver_id').change(function() {
            table.draw();
        });
        $('#car_number').keyup(function() {
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
            overnight: 0,
            overnight2: 0,
            overnightdriv: 0,
            due: 0,
            nm: 0,
            shoaa: 0,
            tahmel_between: 0,
            tankat: 0,
            editid: '',
            trailer_number: '',
            car_number: '',
            charge_date: '',
            decharge_date: '',
            charge_datetwo: '',
            editdrive: "",
            charge_between: 0,
            charge_betweendef: 0,
            scharge_betweendef: {{ $shiping->typ->days }},
            scharge_betweendef2: {{ $shiping->typ->daystwo }},
            data: [],
            datapay: [],
            amountpay: 0,
            supplier_err: '',
            drivers: [],
            driver_id: null,
            name_ar: '',
            name_fr: '',
            name: '',
            nolon: {{ $shiping->typ->nolon }},
            tax: 0,
            gmrok: 0,
            karta: 0,
            mizan: 0,
            kobry: 0,
            transfar: 0,
            leaval: 0,
            goverment: 0,
            balance_fees: 0,
            entry: 0,
            stovern1: {{ $shiping->typ->overnightone }},
            stovern2: {{ $shiping->typ->overnight }},

            enamel_door: 0,
            accommodation: 0,
            totalone: 0,
            covenant: 0,
            discount: 0,
            blank_slice: 0,
            full_slice: 0,
            slice_kopry: 0,
            full_kopry: 0,

            localtotal: 0,
            backfilling: 0,
            entrance_fees: 0,
            gard: 0,
            digging: 0,

            drivermony: 0,
            residual: 0,
            paym: 0,
            savepay: true,
            error: []
        },
        methods: {
            async resetpay() {
                this.paym = 0;
                this.residual = 0;
            },
            async savepayment(e) {
                e.preventDefault();
                let formData = new FormData(document.getElementById('recip'));
                Swal.showLoading()
                axios.post('{{ route('payment.store') }}', formData).then(response => {
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

                        // const collapseElement = $('#multiCollapseExample1');
                        // collapseElement.collapse('hide');
                    }

                }).catch(response => {
                    console.log(response);
                    swal({
                        title: response.response.data.message,
                        type: 'warning',
                        confirmButtonText: 'موافق',
                    });

                })
                this.resetpay()
            },
            async account() {
                this.savepay = true
                let u = parseFloat(this.amountpay) + parseFloat(this.paym)
                if (parseFloat(this.data.due) - u < 0) {
                    this.savepay = false
                    this.residual = 0
                    return
                }
                this.residual = parseFloat(this.data.due) - u
            },
            async createnew() {

                $('#driver_idd').val('').trigger('change');
                this.overnight = 0
                this.due = 0
                this.nm = 0
                this.shoaa = 0
                this.tahmel_between = 0
                this.tankat = 0
                this.editid = ""
                this.digging = 0
                this.transfar = 0
                this.trailer_number = 0
                this.tax = 0

                this.slice_kopry = 0
                this.overnight2 = 0,
                    this.overnight = 0,
                    this.overnightdriv = 0,
                    this.nolon = {{ $shiping->typ->nolon }},
                    this.mizan = 0
                this.leaval = 0
                this.kobry = 0
                this.karta = 0
                this.goverment = 0
                this.gmrok = 0
                this.gard = 0
                this.full_slice = 0
                this.full_kopry = 0
                this.entry = 0
                this.entrance_fees = 0
                this.enamel_door = 0
                this.totalone = 0
                this.driver_id = null
                this.discount = 0
                this.digging = 0
                this.decharge_date = 0
                this.covenant = 0
                this.charge_datetwo = 0
                this.charge_date = 0
                this.charge_between = 0
                this.car_number = 0
                this.blank_slice = 0
                this.balance_fees = 0
                this.backfilling = 0
                this.accommodation = 0
                this.drivermony = 0
                this.overnightdriv = 0

                // this.calc()
            },
            async getedit() {

                url = '{{ route('shiping.editDriver', ':id') }}',
                    url1 = url.replace(':id', this.editdrive);
                storages = axios.get(url1).then(response => {
                    // if (response.status !== 200) {
                    //     console.log(response);
                    //     if (response.data.err == true) {
                    //         swal({
                    //             title: response.data.msg,
                    //             type: 'warning',
                    //             confirmButtonText: 'موافق',
                    //         });
                    //     }
                    //     return
                    // }
                    $('#driver_idd').val(response.data.data.driver_id).trigger('change');
                    console.log(response.data.data)
                    this.editid = response.data.data.id
                    this.digging = response.data.data.digging
                    this.transfar = response.data.data.transfar
                    this.trailer_number = response.data.data.trailer_number
                    this.tax = response.data.data.tax
                    this.tahmel_between = response.data.data.tahmel_between
                    
                    this.slice_kopry = response.data.data.slice_kopry
                    this.overnight2 = response.data.data.overnight2
                    this.overnight = response.data.data.overnight
                    this.overnightdriv = response.data.data.overnightdriv
                    this.nolon = response.data.data.nolon
                    this.mizan = response.data.data.mizan
                    this.leaval = response.data.data.leaval
                    this.kobry = response.data.data.kobry
                    this.karta = response.data.data.karta
                    this.goverment = response.data.data.goverment
                    this.gmrok = response.data.data.gmrok
                    this.gard = response.data.data.gard
                    this.full_slice = response.data.data.full_slice
                    this.full_kopry = response.data.data.full_kopry
                    this.entry = response.data.data.entry
                    this.entrance_fees = response.data.data.entrance_fees
                    this.enamel_door = response.data.data.enamel_door
                    this.due = response.data.data.due // 
                    this.driver_id = response.data.data.driver_id
                    this.discount = response.data.data.discount
                    this.decharge_date = response.data.data.decharge_date
                    this.covenant = response.data.data.covenant
                    this.charge_datetwo = response.data.data.charge_datetwo
                    this.charge_date = response.data.data.charge_date
                    this.charge_between = response.data.data.charge_between
                    this.car_number = response.data.data.car_number
                    this.blank_slice = response.data.data.blank_slice
                    this.balance_fees = response.data.data.balance_fees
                    this.backfilling = response.data.data.backfilling
                    this.accommodation = response.data.data.accommodation
                    this.totalone = response.data.data.totalone /// الصافي
                    this.drivermony = response.data.data.drivermony ///السائق
                    const collapseElement = $('#multiCollapseExample1');
                    collapseElement.collapse('show');


                })

                // this.calc()
                // const button = document.getElementById('addd');
                // button.click();

            },
            setDate: function() {
                if (this.charge_date == '')
                    return;
                let firstdate = new Date(this.charge_date);
                out = new Date(firstdate.setDate(firstdate.getDate() + parseInt(this.scharge_betweendef)))
                    .toISOString().slice('.')
                let out2 = out.split('T');
                // console.log(out)
                // console.log(out2)
                // this.decharge_date = out2[0] //  تاريخ الاستلام
            },
            async clothdate(){
                const selectedDate = document.getElementById('charge_date').value;
                const decharge_date = document.getElementById('decharge_date');         
                const charge_datetwo = document.getElementById('charge_datetwo');         
                if (selectedDate) {
                // اضبط الحد الأدنى لتاريخ النهاية ليكون مساويًا لتاريخ البداية
                    decharge_date.min = selectedDate;
                    charge_datetwo.min = selectedDate;
                }
            },
            async calcdays() {

                const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds 
                const date1 = new Date(this.charge_date);
                const date2 = new Date(this.decharge_date);
                const date3 = new Date(this.charge_datetwo);

               
                const diffDays = Math.round(Math.abs((date1 - date2) / oneDay)); //  حساب الفرق باﻷيام
                const diffDaystwo = Math.round(Math.abs((date3 - date2) /oneDay)); // للسواق حساب الفرق باﻷيام

                this.charge_between = (diffDays + 1) - this.scharge_betweendef // اجمالي عدد الايام مينص عدد ايام الرحله 
                let y = (diffDaystwo + 1) - this.scharge_betweendef // اجمالي عدد الايام مينص عدد ايام الرحله بتاع السواق
                if (y > 0) this.tahmel_between = parseFloat(y)
                console.log(this.charge_between)
                console.log(this.charge_between)
                if (this.charge_between > this.scharge_betweendef2) { // لو عدد ايام الفرق اكبر من 10 اللي هو المطلوب 
                    let first = this.scharge_betweendef2 * this.stovern1; //  هيضرب العدد ده في المبيت رقم 1 
                    let secound = (this.charge_between - this.scharge_betweendef2) * this.stovern2; // هياخد فرق الايام من الموجود وفرق ايام الوصول ويجيب الفرق يضربه ف المبيت 2
                    this.overnight = parseFloat(first) + parseFloat(secound); // بيجمع الاتنين سوا 
                } else if (this.charge_between > 0) {
                    this.overnight = parseFloat(this.charge_between) * parseFloat(this.stovern1);
                } else {
                    this.overnight = 0;
                }

                if (y > this.scharge_betweendef2) { // لو عدد ايام الفرق اكبر من 10 اللي هو المطلوب 
                    let firstt = this.scharge_betweendef2 * this.stovern1; //  هيضرب العدد ده في المبيت رقم 1 
                    let secoundd = (y - this.scharge_betweendef2) * this.stovern2; // هياخد فرق الايام من الموجود وفرق ايام الوصول ويجيب الفرق يضربه ف المبيت 2
                    this.overnightdriv = parseFloat(firstt) + parseFloat(secoundd); // بيجمع الاتنين سوا 
                } else if (y > 0) {
                    this.overnightdriv = parseFloat(y) * parseFloat(this.stovern1);
                } else {
                    this.overnightdriv = 0;
                }
                await this.calc()
            },
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
            async sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            },
            saveData: function(e) {
                e.preventDefault();
                let formData = new FormData(document.getElementById('createEmployee'));
                Swal.showLoading()
                axios.post('{{ route('shiping.storeDrivershiping') }}', formData).then(response => {
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
                        this.sleep(10)
                        this.createnew()

                        const collapseElement = $('#multiCollapseExample1');
                        collapseElement.collapse('hide');
                        location.reload(true);
                    }
                    
                }).catch(response => {
                    console.log(response);
                    swal({
                        title: response.response.data.message,
                        type: 'warning',
                        confirmButtonText: 'موافق',
                    });
                    $('#shiping').DataTable().draw();
                })
            },
            async newsuplier(e) {
                e.preventDefault();
                let formData = new FormData(document.getElementById('createsuplier'));
                // Swal.showLoading()

                axios.post('{{ route('driver.store') }}', formData).then(response => {
                    console.log(response)
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
            async calc() {


                // this.accommodation = 0
                // Calculate totalone
                this.totalone = parseFloat(this.nolon) + parseFloat(this.tax) + parseFloat(this.gmrok) +
                    parseFloat(this.karta) + parseFloat(this.mizan) + parseFloat(this.kobry) +
                    parseFloat(this.transfar) + parseFloat(this.leaval) + parseFloat(this.goverment) +
                    parseFloat(this.balance_fees) + parseFloat(this.entry) + parseFloat(this.overnight) +
                    parseFloat(this.enamel_door) + parseFloat(this.overnight2) + parseFloat(this.digging) +
                    parseFloat(this.backfilling) + parseFloat(this.tankat) + parseFloat(this.shoaa) +
                    parseFloat(this.full_slice) + parseFloat(this.blank_slice) +
                    parseFloat(this.full_kopry) + parseFloat(this.slice_kopry) +
                    parseFloat(this.gard) + parseFloat(this.entrance_fees)
                // Calculate min
                this.min = parseFloat(this.covenant) + parseFloat(this.discount) + parseFloat(this.accommodation);
                // Calculate due
                this.due = parseFloat(this.totalone) - parseFloat(this.min)

                @if ($shiping->type !== 1)
                        
                  this.drivermony = this.totalone
                @else

                    this.drivermony = parseFloat(this.totalone) - parseFloat(this.overnight) + parseFloat(this.overnightdriv)
                    this.due = parseFloat(this.drivermony) - parseFloat(this.min)

                @endif
            }

        },
        created() {
            this.getdrivers();

        }
    });

    function printPdf(pdf) {
        var iframe = document.createElement('iframe');
        iframe.style.display = "none";
        // iframe.style.dir = "rtl";
        iframe.src = pdf;

        document.body.appendChild(iframe);
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    }
</script>

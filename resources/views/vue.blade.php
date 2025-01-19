{{-- <script src="{{ url('assets/vue.js') }}"></script> --}}
<script src="{{ url('assets/vuedev.js') }}"></script>
<script src="{{ url('assets/axiox.js') }}"></script>
<script src="{{ URL::asset('js/sweetalert2@11.js') }}"></script>
<script src="{{ URL::asset('js/sweetalert2.all.js') }}"></script>

<script src="{{ URL::asset('myhelper/datatablesum.js') }}"></script>





<script>
    $(function() {
        $('.select2').select2()
    });

    function __print_receipt(section_id = null) {
        var iframe = document.getElementById(section_id);


        setTimeout(function() {
            window.print();
        }, 1000);
    }




    function adawe(route, data) {
        axios.post(route, data).then(response => {
            if (response.status !== 200) {
                console.log(response)
            } else {
                console.log(response);
                if (response.data.err == true) {
                    swal({
                        title: response.data.msg || response.data.message || "Default title",
                        type: 'warning',
                        confirmButtonText: 'موافق',
                    });
                } else {
                    swal({
                        title: response.data.msg || response.data.message || "Default title",
                        type: 'success',
                        confirmButtonText: 'موافق',
                    });
                    return response.data.err;
                }
            }
        }).catch(response => {
            console.log(response)
        })
    }

    async function adawe2(route) {
        await axios.get(route).then(response => {
            if (response.status !== 200) {
                console.log(response)
            } else {
                console.log(response);
                if (response.data.err == true) {
                    swal({
                        title: response.data.msg || response.data.message || "Default title",
                        type: 'warning',
                        confirmButtonText: 'موافق',
                    });
                } else {
                    return response.data;
                }
            }
        }).catch(response => {
            console.log(response)
        })
    }


    function printPdf(link) {
        var iframe = document.createElement('iframe');
        iframe.style.display = "none";
        // iframe.style.dir = "rtl";
        iframe.src = link;

        document.body.appendChild(iframe);
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    }

    function alertWar(message) {
        swal({
            title: message,
            type: 'warning',
            confirmButtonText: 'موافق',
        });
        return 0;
    }
</script>

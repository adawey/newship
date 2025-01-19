function print(url) {
    var iframefunction = document.createElement('iframe');
    iframefunction.style.display = "none";
    iframefunction.src = url;
    document.body.appendChild(iframefunction);
    setTimeout(function () {
        iframefunction.contentWindow.focus();
        iframefunction.contentWindow.print();
        Swal.close()
    }, 3000);

}

function goleave(url) {
    setTimeout(() => {
        location.href = url
    }, 100);
}




{/* <i class="las la-eye"></i> */ }

$('.show_confirm').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: 'Apakah Anda Yakin?',
        text: 'Data akan dihapus permanen jika Anda melanjutkan proses',
        icon: 'warning',
        buttons: ["Batal", "Hapus"],
        dangerMode: true,
        timer: false,
    })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Data Berhasil Dihapus", {
                    icon: "success",
                });
            }
            else {
                swal("Anda Membatalkan Proses", {
                    icon: "error",
                });
            }
        });
});
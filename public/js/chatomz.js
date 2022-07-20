$(function () {
	//Initialize Select2 Elements
	$('.listdata' ).select2( {
        theme: 'bootstrap-5',
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
      });
  });
  
$(document).ready(function() {
	

	$('.pop-info').tooltip();

	$('[data-toggle="tooltip"]').tooltip();
});

function deleteRow(id,key='data')
        {
            swal({
                title: "Yakin akan menghapus data ini?",
                text: "Data yang terhapus tidak bisa dikembalikan lagi!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#'+key+'-'+id).submit();
                    }
                });
		}

    var crupiah = document.getElementsByClassName('nilai-rupiah');
	crupiah.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		crupiah.value = formatRupiah(this.value, 'Rp. ');
	});
    var rupiah = document.getElementById('rupiah');
	rupiah.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah.value = formatRupiah(this.value, 'Rp. ');
	});
	var rupiah1 = document.getElementById('rupiah1');
	rupiah1.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah1.value = formatRupiah(this.value, 'Rp. ');
	});
	var rupiah2 = document.getElementById('rupiah2');
	rupiah2.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah2.value = formatRupiah(this.value, 'Rp. ');
	});
	var rupiah3 = document.getElementById('rupiah3');
	rupiah3.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah3.value = formatRupiah(this.value, 'Rp. ');
	});
	var rupiah4 = document.getElementById('rupiah4');
	rupiah4.addEventListener('keyup', function(e){
		rupiah4.value = formatRupiah(this.value, 'Rp. ');
	});
	var rupiah5 = document.getElementById('rupiah5');
	rupiah5.addEventListener('keyup', function(e){
		rupiah5.value = formatRupiah(this.value, 'Rp. ');
	});
	var rupiah6 = document.getElementById('rupiah6');
	rupiah6.addEventListener('keyup', function(e){
		rupiah6.value = formatRupiah(this.value, 'Rp. ');
	});
	var rupiah7 = document.getElementById('rupiah7');
	rupiah7.addEventListener('keyup', function(e){
		rupiah7.value = formatRupiah(this.value, 'Rp. ');
	});

	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
	
		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
	
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
<html>
<head>
	<title>Form Import</title>

	<!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

	<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>
</head>
<body>
	<h3>Form Import</h3>
	<hr>

	<button> <a href="http://localhost/panli_inventory/web/index.php?r=inventory%2Findex">Back</a></button>
	<br>
	<br>

	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<form method="post" action="<?php echo base_url("index.php/Inven/form"); ?>" enctype="multipart/form-data">
		<!--
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
		<input type="file" name="file">

		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<input type="submit" name="preview" value="Preview">
	</form>

	<?php
	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
		if(isset($upload_error)){ // Jika proses upload gagal
			echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
			die; // stop skrip
		}

		// Buat sebuah tag form untuk proses import data ke database
		echo "<form method='post' action='".base_url("index.php/Inven/import")."'>";

		// Buat sebuah div untuk alert validasi kosong
		echo "<div style='color: red;' id='kosong'>
		Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
		</div>";

		echo "<table border='1' cellpadding='8'>
		<tr>
			<th colspan='10'>Preview Data</th>
		</tr>
		<tr>
		<th>PDAID</th>
		<th>Part Number</th>
		<th>Location</th>
		<th>QTY</th>
		<th>Out</th>
		<th>Remarks</th>
		<th>Created By</th>
		<th>Updated By</th>
	</tr>";

		$numrow = 1;
		$kosong = 0;

		// Lakukan perulangan dari data yang ada di excel
		// $sheet adalah variabel yang dikirim dari controller
		foreach($sheet as $row){
			// Ambil data pada excel sesuai Kolom
			$pdaid=$row['A']; // Insert data nis dari kolom A di excel
		$part_number=$row['B']; // Insert data nama dari kolom B di excel
		$location=$row['C']; // Insert data jenis kelamin dari kolom C di excel
		$qty=$row['D']; // Insert data alamat dari kolom D di excel
		$out=$row['E'];
		$remarks=$row['F'];
		$created_by=$row['G'];
		$updated_by=$row['H'];

			// Cek jika semua data tidak diisi
			if(empty($pdaid) && empty($part_number) && empty($location) && empty($qty)
			&& empty($out) && empty($remarks) && empty($created_by) && empty($updated_by))
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Validasi apakah semua data telah diisi
				$id_td = ( ! empty($id))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
			$pdaid_td = ( ! empty($pdaid))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
			$partnumber_td = ( ! empty($part_number))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
			$loc_td = ( ! empty($location))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
			$qty_td = ( ! empty($qty))? "" : " style='background: #E07171;'";
			$out_td = ( ! empty($out))? "" : " style='background: #E07171;'";
			$remarks_td = ( ! empty($remarks))? "" : " style='background: #E07171;'";
			$create_td = ( ! empty($created_by))? "" : " style='background: #E07171;'";
			$update_td = ( ! empty($updated_by))? "" : " style='background: #E07171;'";

				// Jika salah satu data ada yang kosong
				if(empty($pdaid) or empty($part_number) or empty($location) or empty($qty)
			or empty($out) or empty($remarks) or empty($created_by)){
					$kosong++; // Tambah 1 variabel $kosong
				}

				echo "<tr>";
	echo "<td".$pdaid_td.">".$pdaid."</td>";
	echo "<td".$partnumber_td.">".$part_number."</td>";
	echo "<td".$loc_td.">".$location."</td>";
	echo "<td".$qty_td.">".$qty."</td>";
	echo "<td".$out_td.">".$out."</td>";
	echo "<td".$remarks_td.">".$remarks."</td>";
	echo "<td".$create_td.">".$created_by."</td>";
	echo "<td".$update_td.">".$updated_by."</td>";
	echo "</tr>";
}
			$numrow++; // Tambah 1 setiap kali looping
		}

		echo "</table>";

		// Cek apakah variabel kosong lebih dari 0
		// Jika lebih dari 0, berarti ada data yang masih kosong
		if($kosong > 0){
		?>
			<script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');

				$("#kosong").show(); // Munculkan alert validasi kosong
			});
			</script>
		<?php
		}else{ // Jika semua data sudah diisi
			echo "<hr>";

			// Buat sebuah tombol untuk mengimport data ke database
			echo "<button type='submit' name='import'>Import</button>";
			echo "<a href='".base_url("index.php/Inven")."'>Cancel</a>";
		}

		echo "</form>";
	}
	?>
</body>
</html>

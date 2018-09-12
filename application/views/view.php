<html>
<head>
	<title>PT. PANLI</title>
</head>
<body>
	<h1>Data Inventory</h1>
	<hr>
	<button> <a href="<?php echo base_url("index.php/Inven/form"); ?>">Import Data</a></button>
		 <button> <a href="http://localhost/panli_inventory/web/index.php?r=inventory%2Findex">Back</a></button>
	<table border="1" cellpadding="8">
		<tr>
		    <th>PDAID</th>
		    <th>Part Number</th>
		    <th>Location</th>
		    <th>QTY</th>
		    <th>Out</th>
		    <th>Remarks</th>
		    <th>Created By</th>
		    <th>Updated By</th>
		  </tr>

	<?php
	if( ! empty($inventory)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
		foreach($inventory as $data){ // Lakukan looping pada variabel Inven dari controller
			echo "<tr>";
			     // echo "<td>".$data->id."</td>";
			      echo "<td>".$data->pdaid."</td>";
			      echo "<td>".$data->part_number."</td>";
			      echo "<td>".$data->location."</td>";
			      echo "<td>".$data->qty."</td>";
			      echo "<td>".$data->out."</td>";
			      echo "<td>".$data->remarks."</td>";
			      echo "<td>".$data->created_by."</td>";
			      echo "<td>".$data->updated_by."</td>";
			      echo "</tr>";
			    }
	}else{ // Jika data tidak ada
		echo "<tr><td colspan='11'>Data tidak ada</td></tr>";
	}
	?>
	</table>

		<button> <a href="http://localhost/panli_inventory/web/index.php?r=inventory%2Findex">Back</button>
</body>
</html>

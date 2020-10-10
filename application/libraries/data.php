<table border="1">
	<tr>
		<th>No.</th>
		<th>ID Laporan</th>
		<th>Nama pelapor</th>
		<th>Tanggal laporan</th>
    <th>Deskripsi Laporan</th>
	</tr>
	<?php

	//query menampilkan data
  $que = "SELECT `laporan_kstm`.*, `user`.`name`
           FROM `laporan_kstm` JOIN `user`
           ON `laporan_kstm`.`id_pelapor` = `user`.`id`
           ORDER BY  `user`.`name` ASC";
  $query = $this->db->query($que);
	$no = 1;
	while($data = mysql_fetch_assoc($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['id_laporan_kstm'].'</td>
			<td>'.$data['name'].'</td>
			<td>'.date('d F Y',$data['tanggal_laporan']).'</td>
      <td>'.$data['deskripsi_laporan'].'</td>
		</tr>
		';
		$no++;
	}
	?>
</table>

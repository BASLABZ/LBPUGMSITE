<?php
include '../../inc/inc-db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pengajuan</title>
</head>
<body>
	<table border="1">
		<thead>
			<th>NO</th>
			<th>NAMA</th>
			<th>TANGGAL PENDAFTARAN</th>
			<th>INSTANSI</th>
			<th>FAKULTAS / BIDANG</th>
			<th>KATEGORI</th>
			<th>GENDER</th>
			<th>EMAIL</th>
			<th>STATUS</th>
		</thead>
		<tbody>
			<?php
				$no =1;
				$show = mysql_query("SELECT * from tbl_member A join ref_category B on A.category_id_fk = B.category_id");
				while ($runshow = mysql_fetch_array($show)) {
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $runshow['member_name']; ?></td>
					<td><?php echo $runshow['member_register_date']; ?></td>
					<td><?php echo $runshow['member_institution']; ?></td>
					<td><?php echo $runshow['member_faculty']; ?></td>
					<td><?php echo $runshow['category_name']; ?></td>
					<td><?php echo $runshow['member_gender']; ?></td>
					<td><?php echo $runshow['member_email']; ?></td>
					<td><?php echo $runshow['member_status']; ?></td>
				</tr> 
				<?php
				}
			?>
		</tbody>
	</table>
</body>
</html>
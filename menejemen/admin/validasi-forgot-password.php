<?php
include 'configuration-add.php';
session_start();
error_reporting();


$var_user			= $_POST['frm_user'];
$var_hintquestion 	= $_POST['frm_hint'];
$var_answerquestion = $_POST['frm_answer'];

$query="select * from ".$ref_operator." where operator_username='".$var_user."'";
$run_query=mysql_query($query);
$query1=$query." and hint_question_user='".$var_hintquestion."'";
$run_query1=mysql_query($query1);
$query2=$query1." and answer_question_user='".$var_answerquestion."'";
$run_query2=mysql_query($query2);

$jml=mysql_num_rows($run_query);
$jml1=mysql_num_rows($run_query1);
$jml2=mysql_num_rows($run_query2);

$data=mysql_fetch_array($run_query2);

if ($jml>0){
	if($jml1>0){
		if($jml2>0){
			$update="update ".$var_admin_table." set status_login_user='1' where username_user='".$var_user."'";
			$run_update=mysql_query($update);
			$_SESSION['user']=$data['operator_username'];
			$_SESSION['pass']=$data['operator_password'];
			$_SESSION['nama_user']=$data['operator_name'];
			$_SESSION['id_level']=$data['level_id'];
			$_SESSION['id_user']=$data['id_user'];
			?>
			<script type="text/javascript">alert('Alternatif login berhasil!');document.location='home.php'</script>
			<?php
		}else{
			?>
		<script type="text/javascript">alert('Maaf jawaban sandi anda salah!');document.location='forgot-pass.php'</script>
		<?php
		}
	}else{
	?>
	<script type="text/javascript">alert('Maaf pertanyaan sandi anda salah!');document.location='forgot-pass.php'</script>
	<?php	
	}
}else{
?>
<script type="text/javascript">alert('Maaf username anda salah!');document.location='forgot-pass.php'</script>
<?php	
}
?>
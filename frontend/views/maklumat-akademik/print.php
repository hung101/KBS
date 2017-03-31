<?php
use app\models\RefHari;
?>

<div align="center" class="text-bold titleSize"><?= strtoupper($title) ?><br />MAJLIS SUKAN NEGARA</div>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    MAKLUMAT ATLET
</div>

<table>
    <tr>
        <td>ATLET</td><td>:</td><td><?= $model->atlet ?></td>
    </tr>
    <tr>
        <td>SUKAN</td><td>:</td><td><?= $model->sukan ?></td>
    </tr>
    <tr>
        <td>PROGRAM</td><td>:</td><td><?= $model->program ?></td>
    </tr>
    <tr>
        <td>NO. MATRIK</td><td>:</td><td><?= $model->no_matrik ?></td>
    </tr>
    <tr>
        <td>FAKULTI</td><td>:</td><td><?= $model->fakulti ?></td>
    </tr>
    <tr>
        <td>NO TELEFON</td><td>:</td><td><?= $model->atlet_no_tel ?></td>
    </tr>
	<tr>
        <td>NO. HP</td><td>:</td><td><?= $model->atlet_hp_no ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    MAKLUMAT <?= strtoupper("Penasihat Akademik") ?>
</div>

<table>
    <tr>
        <td>NAMA PENASIHAT AKADEMIK</td><td>:</td><td><?= $model->penasihat_akademik ?></td>
    </tr>
    <tr>
        <td>NO TELEFON</td><td>:</td><td><?= $model->atlet_no_tel ?></td>
    </tr>
	<tr>
        <td>NO. HP</td><td>:</td><td><?= $model->atlet_hp_no ?></td>
    </tr>
</table>
<h3 class="text-underline">Semester</h3>
<table>
    <tr>
        <td>SEMESTER</td><td>:</td><td><?= $model->semester ?></td>
    </tr>
    <tr>
        <td>JUM. SEMESTER</td><td>:</td><td><?= $model->jumlah_semester ?></td>
    </tr>
	<tr>
        <td>JUM. TAHUN</td><td>:</td><td><?= $model->jumlah_tahun ?></td>
    </tr>
	<tr>
        <td>TAHUN KEMASUKAN</td><td>:</td><td><?= $model->tahun_kemasukan ?></td>
    </tr>
</table>
<pagebreak />
<h3 class="text-underline">Jadual</h3>
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th width="8%">BIL</th>
		<th width="12%">HARI</th>
		<th width="20%">MASA</th>
		<th width="70%">PERKARA</th>
	</tr>
	<?php
	foreach($MaklumatAkademikJadual as $key=>$value){
		$ref = RefHari::findOne($value['hari']);
		$value['hari'] = $ref['desc'];
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td align="center"><?= $value['hari'] ?></td>
		<td><?= $value['masa_dari'].' - '.$value['masa_hingga'] ?></td>
		<td><?= $value['perkara'] ?></td>
	</tr>
	<?php	
	}
	?>
</table>

<h3 class="text-underline">Subjek</h3>
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th>BIL</th>
		<th>KOD SUBJEK</th>
		<th>SUBJEK</th>
		<th>BIL KREDIT</th>
		<th>NAMA PENSYARAH</th>
		<th>NO TELEFON</th>
		<th>E-MAIL</th>
	</tr>
	<?php
	foreach($MaklumatAkademikSubjek as $key=>$value){
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td align="center"><?= $value['kod_subjek'] ?></td>
		<td><?= $value['subjek'] ?></td>
		<td align="center"><?= $value['bil_kredit'] ?></td>
		<td><?= $value['nama_pensyarah'] ?></td>
		<td align="center"><?= $value['no_telefon'] ?></td>
		<td align="center"><?= $value['email']?></td>
	</tr>
	<?php	
	}
	?>
</table>
<?php
use app\models\RefJenisElaunJurulatih;
?>

<table width="60%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="right"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="90"></td>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?><br />MAJLIS SUKAN NEGARA</div>
			
		</td>
	</tr>
</table>

<table>
    <tr>
        <td>NAMA JURULATIH</td><td>:</td><td><?= $model->nama_jurulatih ?></td>
    </tr>
    <tr>
        <td>NO.KAD PENGENALAN</td><td>:</td><td><?= $model->no_kad_pengenalan ?></td>
    </tr>
	<tr>
        <td>NO.PEKERJA</td><td>:</td><td><?= $model->no_pekerja ?></td>
    </tr>    
	<tr>
        <td>NO.KWSP</td><td>:</td><td><?= $model->no_kwsp ?></td>
    </tr>
	<tr>
        <td>PROGRAM</td><td>:</td><td><?= $model->program ?></td>
    </tr>
    <tr>
        <td>NAMA SUKAN</td><td>:</td><td><?= $model->nama_sukan ?></td>
    </tr>
	<tr>
        <td>TARIKH MULA</td><td>:</td><td><?= ($model->tarikh_mula)?date('d.m.Y', strtotime($model->tarikh_mula)):null ?></td>
    </tr>    
	<tr>
        <td>TARIKH TAMAT</td><td>:</td><td><?= ($model->tarikh_tamat)?date('d.m.Y', strtotime($model->tarikh_tamat)):null ?></td>
    </tr>
	<tr>
        <td>BANK</td><td>:</td><td><?= $model->bank ?></td>
    </tr>
    <tr>
        <td>NO.AKAUN</td><td>:</td><td><?= $model->no_akaun ?></td>
    </tr>
	<tr>
        <td>CAWANGAN</td><td>:</td><td><?= $model->cawangan ?></td>
    </tr>    
	<tr>
        <td>CATATAN</td><td>:</td><td><?= $model->catatan ?></td>
    </tr>
</table>

<h4 class="text-underline">GAJI JURULATIH</h4>
<?php
if(count($GajiJurulatih) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>JUMLAH (RM)</th>
			<th>TARIKH MULA</th>
			<th>TARIKH TAMAT</th>
		</tr>
		<?php
		$count = 1;
		foreach($GajiJurulatih as $item){
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= number_format($item->jumlah,2) ?></td>
				<td align="center"><?= ($item->tarikh_mula)?date('d.m.Y', strtotime($item->tarikh_mula)):null ?></td>
				<td align="center"><?= ($item->tarikh_tamat)?date('d.m.Y', strtotime($item->tarikh_tamat)):null ?></td>
			</tr>
		<?php
			$count++;
		}
		?>
	</table>
<?php	
}else{
	echo '<p>Tiada Maklumat</p>';
}
?>
<h4 class="text-underline">ELAUN JURULATIH</h4>
<?php
if(count($ElaunJurulatih) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>TARIKH MULA</th>
			<th>TARIKH TAMAT</th>
			<th>JENIS ELAUN</th>
			<th>JUMLAH ELAUN(RM)</th>
		</tr>
		<?php
		$count = 1;
		foreach($ElaunJurulatih as $item){
			$ref = RefJenisElaunJurulatih::findOne(['id' => $item->jenis_elaun]);
			$item->jenis_elaun = $ref['desc'];
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= ($item->tarikh_mula)?date('d.m.Y', strtotime($item->tarikh_mula)):null ?></td>
				<td align="center"><?= ($item->tarikh_tamat)?date('d.m.Y', strtotime($item->tarikh_tamat)):null ?></td>
				<td><?= $item->jenis_elaun ?></td>
				<td align="center"><?= number_format($item->jumlah_elaun,2) ?></td>
			</tr>
		<?php
			$count++;
		}
		?>
	</table>
<?php	
}else{
	echo '<p>Tiada Maklumat</p>';
}
?>
<br />
<table>
    <tr>
        <td><?= strtoupper("Dokumen Muat Naik (Buku Akaun)") ?></td><td>:</td><td><?= ($model->dokumen_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
    <tr>
        <td>SURAT TAWARAN</td><td>:</td><td><?= ($model->surat_tawaran != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>KELULUSAN PINJAMAN</td><td>:</td><td><?= ($model->kelulusan_pinjaman != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>    
	<tr>
        <td>REKOD CUTI</td><td>:</td><td><?= ($model->rekod_cuti != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
</table>
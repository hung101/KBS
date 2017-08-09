<?php
// use app\models\Jurulatih;

?>

<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="right"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="90"></td>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?><br />MAJLIS SUKAN NEGARA</div>
			
		</td>
	</tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    MAKLUMAT PENYERTAAN
</div>

<table>
    <tr>
        <td valign="top"><?= strtoupper("Nama Kejohanan / Pertandingan") ?></td><td valign="top">:</td><td><?= $model->nama_kejohanan_pertandingan ?></td>
    </tr>
    <tr>
        <td>PERINGKAT</td><td>:</td><td><?= $model->peringkat ?></td>
    </tr>
    <!--<tr>
        <td>SUKAN</td><td>:</td><td><?= $model->sukan ?></td>
    </tr>-->   
	<tr>
        <td>NEGERI</td><td>:</td><td><?= $model->negeri_penyertaan ?></td>
    </tr>
	<tr>
        <td>TARIKH MULA</td><td>:</td><td><?= ($model->tarikh_mula)?date('d.m.Y', strtotime($model->tarikh_mula)):null ?></td>
    </tr>
	<tr>
        <td>TARIKH TAMAT</td><td>:</td><td><?= ($model->tarikh_tamat)?date('d.m.Y', strtotime($model->tarikh_tamat)):null ?></td>
    </tr>
	<tr>
        <td>TEMPAT</td><td>:</td><td><?= $model->tempat ?></td>
    </tr>
	<tr>
        <td>TUJUAN</td><td>:</td><td><?= $model->tujuan ?></td>
    </tr> 
	<tr>
        <td>BILANGAN PASUKAN</td><td>:</td><td><?= $model->bil_pasukan ?></td>
    </tr>
	<tr>
        <td>BILANGAN PESERTA</td><td>:</td><td><?= $model->bil_peserta ?></td>
    </tr> 
	<tr>
        <td><?= strtoupper("Anggaran Perbelanjaan (RM)") ?></td><td>:</td><td><?= number_format($model->anggaran_perbelanjaan,2) ?></td>
    </tr>    
</table>
<section>
<h4 class="text-underline"><?= strtoupper("Sukan") ?></h4>
<?php
if(count($BantuanPenganjuranKejohananSirkitSukan) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>SUKAN</th>
		</tr>
		<?php
		$count = 1;
		foreach($BantuanPenganjuranKejohananSirkitSukan as $item){
			
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= $item->refSukan->desc ?></td>
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
</section>
<section>
<h4 class="text-underline"><?= strtoupper("Sumber-Sumber Kewangan Lain Untuk Kejohanan / Pertandingan") ?></h4>
<?php
if(count($BantuanPenganjuranKejohananSirkitKewangan) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>SUMBER KEWANGAN</th>
			<th>NYATAKAN (JIKA LAIN-LAIN)</th>
			<th>JUMLAH (RM)</th>
		</tr>
		<?php
		$count = 1;
		foreach($BantuanPenganjuranKejohananSirkitKewangan as $item){
			
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= $item->refSumberKewanganBantuanPenganjuranKejohanan->desc ?></td>
				<td align="center"><?= $item->lain_lain ?></td>
				<td align="center"><?= number_format($item->jumlah,2) ?></td>
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
</section>
<section>
<h4 class="text-underline"><?= strtoupper("Bayaran Penyertaan Kejohanan / Pertandingan Yang Dikenakan Kepada Peserta / Pasukan") ?></h4>
<?php
if(count($BantuanPenganjuranKejohananSirkitBayaran) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>JENIS BAYARAN</th>
			<th>NYATAKAN (JIKA LAIN-LAIN)</th>
			<th>JUMLAH (RM)</th>
		</tr>
		<?php
		$count = 1;
		foreach($BantuanPenganjuranKejohananSirkitBayaran as $item){
			
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= $item->refJenisBayaranBantuanPenganjuranKejohanan->desc ?></td>
				<td align="center"><?= $item->lain_lain ?></td>
				<td align="center"><?= number_format($item->jumlah,2) ?></td>
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
</section>
<section>
<h4 class="text-underline"><?= strtoupper("Elemen Bantuan Yang Dipohon") ?></h4>
<?php
if(count($BantuanPenganjuranKejohananSirkitElemen) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>ELEMEN BANTUAN</th>
			<th>SUB ELEMEN</th>
			<th>KADAR</th>
			<th>BILANGAN</th>
			<th>HARI</th>
			<th>JUMLAH (RM)</th>
		</tr>
		<?php
		$count = 1;
		foreach($BantuanPenganjuranKejohananSirkitElemen as $item){
			
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= $item->refElemenBantuanPenganjuranKejohanan->desc ?></td>
				<td align="center"><?= $item->refSubElemenBantuanPenganjuranKejohanan->desc ?></td>
				<td align="center"><?= $item->kadar ?></td>
				<td align="center"><?= $item->bilangan ?></td>
				<td align="center"><?= $item->hari ?></td>
				<td align="center"><?= number_format($item->jumlah,2) ?></td>
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
</section>
<section>
<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
	<?= strtoupper("KEJOHANAN YANG TELAH DIANJUR (TAHUN SEMASA & TAHUN SEBELUM)") ?>
</div>
<?php
if(count($BantuanPenganjuranKejohananSirkitDianjurkan) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>KEJOHANAN</th>
			<th>TARIKH MULA</th>
			<th>TARIKH TAMAT</th>
			<th>TEMPAT</th>
			<th>PERINGKAT</th>
			<th>JUMLAH (RM)</th>
		</tr>
		<?php
		$count = 1;
		foreach($BantuanPenganjuranKejohananSirkitDianjurkan as $item){
			
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= $item->kejohanan ?></td>
				<td align="center"><?= ($item->tarikh_mula)?date('d.m.Y', strtotime($item->tarikh_mula)):null ?></td>
				<td align="center"><?= ($item->tarikh_tamat)?date('d.m.Y', strtotime($item->tarikh_tamat)):null ?></td>
				<td align="center"><?= $item->tempat ?></td>
				<td align="center"><?= $item->refPeringkatBantuanPenganjuranKejohananDianjurkan->desc ?></td>
				<td align="center"><?= number_format($item->jumlah,2) ?></td>
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
</section>
<section>
<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
	<?= strtoupper("BANTUAN GERAN PENGANJURAN OLEH MSN (TAHUN SEMASA & TAHUN SEBELUM)") ?>
</div>
<?php
if(count($BantuanPenganjuranKejohananSirkitOlehMsn) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>KEJOHANAN</th>
			<th>TARIKH MULA</th>
			<th>TARIKH TAMAT</th>
			<th>TEMPAT</th>
			<th>PERINGKAT</th>
			<th>JUMLAH (RM)</th>
			<th>LAPORAN DIKEMUKAKAN</th>
		</tr>
		<?php
		$count = 1;
		foreach($BantuanPenganjuranKejohananSirkitOlehMsn as $item){
			
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= $item->kejohanan ?></td>
				<td align="center"><?= ($item->tarikh_mula)?date('d.m.Y', strtotime($item->tarikh_mula)):null ?></td>
				<td align="center"><?= ($item->tarikh_tamat)?date('d.m.Y', strtotime($item->tarikh_tamat)):null ?></td>
				<td align="center"><?= $item->tempat ?></td>
				<td align="center"><?= $item->refPeringkatBantuanPenganjuranKejohananDianjurkan->desc ?></td>
				<td align="center"><?= number_format($item->jumlah_bantuan,2) ?></td>
				<td align="center"><?= $item->refKelulusan->desc ?></td>
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
</section>
<section>
<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    JUMLAH BANTUAN YANG DIPOHON
</div>

<table>
    <tr>
        <td>RM</td><td>:</td><td><?= number_format($model->jumlah_bantuan_yang_dipohon,2) ?></td>
    </tr>
</table>
</section>
<section>
<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    KEGUNAAN MSN
</div>

<table>
    <tr>
        <td>Status Permohonan</td><td>:</td><td><?= $model->status_permohonan ?></td>
    </tr>
	    <tr>
        <td>Tarikh Permohonan</td><td>:</td><td><?= date('d.m.Y', strtotime($model->tarikh_permohonan)) ?></td>
    </tr>
	    <tr>
        <td>Catatan</td><td>:</td><td><?= $model->catatan ?></td>
    </tr>
	    <tr>
        <td>Jumlah Diluluskan (RM)</td><td>:</td><td><?= $model->jumlah_dilulus ?></td>
    </tr>
		    <tr>
        <td>Bil. JKB</td><td>:</td><td><?= $model->jkb ?></td>
    </tr>
	    <tr>
        <td>Tarikh JKB</td><td>:</td><td><?= ($model->tarikh_jkb)?date('d.m.Y', strtotime($model->tarikh_jkb)):null ?></td>
    </tr>
</table>
</section>
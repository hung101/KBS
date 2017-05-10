<?php
use app\models\general\GeneralLabel;
?>
<table width="100%" border="1" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?></div>
		</td>
	</tr>
</table>

<br />
<table>
    <tr>
        <td><?= strtoupper("Nama Pemohon") ?></td><td>:</td><td><?= $model->nama_permohon ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Tarikh Permohonan") ?></td><td>:</td><td><?= $model->tarikh_permohonan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Tajuk Penyelidikan") ?></td><td>:</td><td><?= $model->tajuk_penyelidikan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Jenis Projek") ?></td><td>:</td><td><?= $model->jenis_projek ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Ringkasan Permohonan") ?></td><td valign="top">:</td><td valign="top"><?= $model->ringkasan_permohonan ?></td>
    </tr>
</table>

<h4 class="text-underline"><?= strtoupper("Penyelidikan Komposisi Pasukan") ?></h4>

<?php
if(count($PenyelidikanKomposisiPasukan) > 0){
?>	
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th>BIL</th>
		<th>NAMA</th>
		<th>JAWATAN</th>
		<th><?= strtoupper("Institusi/Universiti/Syarikat") ?></th>
	</tr>
	<?php
	$count = 1;
	foreach($PenyelidikanKomposisiPasukan as $item){
	?>
		<tr>
			<td><?= $count ?></td>
			<td><?= $item->nama ?></td>
			<td><?= $item->refJawatanPasukanPenyelidikan->desc ?></td>
			<td><?= $item->institusi_universiti_syarikat ?></td>
		</tr>
	<?php
		$count++;
	}
	?>
</table>
<?php
} else {
	echo '<p>Tiada Maklumat</p>';
}
?>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	BUTIRAN AKADEMIK
</div>
<table>
    <tr>
        <td><?= strtoupper("Nama") ?></td><td>:</td><td><?= $model->akademik_nama ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No. Kad Pengenalan") ?></td><td>:</td><td><?= $model->akademik_ic_no ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No Kakitangan") ?></td><td>:</td><td><?= $model->akademik_no_kakitangan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Jenis Perkhidmatan") ?></td><td>:</td><td><?= $model->akademik_jenis_perkhidmatan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Kontrak Tarikh Tamat") ?></td><td>:</td><td><?= $model->akademik_kontrak_tarikh_tamat ?></td>
    </tr>
		<tr>
        <td><?= strtoupper("No Telefon Bimbit") ?></td><td>:</td><td><?= $model->akademik_no_tel_bimbit ?></td>
    </tr>
		<tr>
        <td><?= strtoupper("Emel") ?></td><td>:</td><td><?= $model->akademik_emel ?></td>
    </tr>
		<tr>
        <td valign="top"><?= strtoupper("Nama Yang Dicadangkan /").'<br />'.strtoupper("Berdaftar Institusi Pengajian Tinggi") ?></td><td valign="top">:</td><td valign="top"><?= $model->akademik_nama_yang_dicadangkan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Kursus") ?></td><td>:</td><td><?= $model->akademik_kursus ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	PERSETUJUAN
</div>
<table>
    <tr>
        <td><?= strtoupper("Penyertaan Lembaran Maklumat") ?></td><td>:</td><td><?= ($model->penyertaan_lembaran_maklumat != null || $model->penyertaan_lembaran_maklumat != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada. '.$model->sebab_tiada_penyertaan_lembaran_maklumat ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Borang Persetujuan Penyertaan") ?></td><td>:</td><td><?= ($model->borang_persetujuan_penyertaan != null || $model->borang_persetujuan_penyertaan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada. '.$model->sebab_tiada_borang_persetujuan_penyertaan ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Pengecualian Persetujuan") ?></td><td valign="top">:</td><td valign="top"><?= $model->pengecualian_persetujuan ?></td>
    </tr>
</table>

<h4 class="text-underline"><?= strtoupper("Dokumen Penyelidikan") ?></h4>

<?php
if(count($DokumenPenyelidikan) > 0){
?>	
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th align="center">BIL</th>
		<th>NAMA DOKUMEN</th>
		<th>MUAT NAIK</th>
	</tr>
	<?php
	$count = 1;
	foreach($DokumenPenyelidikan as $item){
	?>
		<tr>
			<td><?= $count ?></td>
			<td><?= $item->refDokumenPenyelidikan->desc ?></td>
			<td><?= ($item->muat_naik != null || $item->muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
		</tr>
	<?php
		$count++;
	}
	?>
</table>
<?php
} else {
	echo '<p>Tiada Maklumat</p>';
}
?>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	BAJET PENYELIDIKAN
</div>

<h4 class="text-underline"><?= strtoupper("Bajet untuk ISN Peralatan, Bahan dan Sumber") ?></h4>
<?php
if(count($BajetPenyelidikan) > 0){
?>	
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th align="center">BIL</th>
		<th>JENIS BAJET</th>
		<th>TAHUN 1</th>
		<th>TAHUN 2</th>
		<th>TAHUN 3</th>
	</tr>
	<?php
	$count = 1;
	$calculate_jumlah_tahun_1 = 0.00;
    $calculate_jumlah_tahun_2 = 0.00;
    $calculate_jumlah_tahun_3 = 0.00;
	foreach($BajetPenyelidikan as $item){
	?>
		<tr>
			<td align="center"><?= $count ?></td>
			<td><?= $item->refJenisBajet->desc ?></td>
			<td><?= number_format($item->tahun_1, 2) ?></td>
			<td><?= number_format($item->tahun_2, 2) ?></td>
			<td><?= number_format($item->tahun_3, 2) ?></td>
		</tr>
	<?php
		$count++;
		$calculate_jumlah_tahun_1 += $item->tahun_1;
		$calculate_jumlah_tahun_2 += $item->tahun_2;
		$calculate_jumlah_tahun_3 += $item->tahun_3;
	}
	$calculate_jumlah_keseluruhan = $calculate_jumlah_tahun_1 + $calculate_jumlah_tahun_2 + $calculate_jumlah_tahun_3;
	?>
</table>
<br />
<strong><?=GeneralLabel::tahun?> 1:</strong> RM <?= number_format($calculate_jumlah_tahun_1, 2) ?> &nbsp;&nbsp;&nbsp;&nbsp; <strong><?=GeneralLabel::tahun?> 2:</strong> RM <?= number_format($calculate_jumlah_tahun_2, 2) ?> &nbsp;&nbsp;&nbsp;&nbsp; <strong><?=GeneralLabel::tahun?> 3:</strong> RM <?= number_format($calculate_jumlah_tahun_3, 2) ?>
<h4><strong><?=GeneralLabel::jumlah_keseluruhan?>: RM <?= number_format($calculate_jumlah_keseluruhan, 2) ?></strong></h4>
<?php
} else {
	echo '<p>Tiada Maklumat</p>';
}
?>

<h4 class="text-underline"><?= strtoupper("Sumbangan Kewangan Atau Bukan Kewangan Dari Rakan Usaha / Institusi") ?></h4>
<?php
if(count($BajetPenyelidikanSumbangan) > 0){
?>	
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th align="center">BIL</th>
		<th>JENIS BAJET</th>
		<th>TAHUN 1</th>
		<th>TAHUN 2</th>
		<th>TAHUN 3</th>
	</tr>
	<?php
	$count = 1;
	$calculate_jumlah_tahun_1 = 0.00;
    $calculate_jumlah_tahun_2 = 0.00;
    $calculate_jumlah_tahun_3 = 0.00;
	foreach($BajetPenyelidikanSumbangan as $item){
	?>
		<tr>
			<td align="center"><?= $count ?></td>
			<td><?= $item->refJenisBajetSumbangan->desc ?></td>
			<td><?= number_format($item->tahun_1, 2) ?></td>
			<td><?= number_format($item->tahun_2, 2) ?></td>
			<td><?= number_format($item->tahun_3, 2) ?></td>
		</tr>
	<?php
		$count++;
		$calculate_jumlah_tahun_1 += $item->tahun_1;
		$calculate_jumlah_tahun_2 += $item->tahun_2;
		$calculate_jumlah_tahun_3 += $item->tahun_3;
	}
	$calculate_jumlah_keseluruhan = $calculate_jumlah_tahun_1 + $calculate_jumlah_tahun_2 + $calculate_jumlah_tahun_3;
	?>
</table>
<br />
<strong><?=GeneralLabel::tahun?> 1:</strong> RM <?= number_format($calculate_jumlah_tahun_1, 2) ?> &nbsp;&nbsp;&nbsp;&nbsp; <strong><?=GeneralLabel::tahun?> 2:</strong> RM <?= number_format($calculate_jumlah_tahun_2, 2) ?> &nbsp;&nbsp;&nbsp;&nbsp; <strong><?=GeneralLabel::tahun?> 3:</strong> RM <?= number_format($calculate_jumlah_tahun_3, 2) ?>
<h4><strong><?=GeneralLabel::jumlah_keseluruhan?>: RM <?= number_format($calculate_jumlah_keseluruhan, 2)?></strong></h4>
<?php
} else {
	echo '<p>Tiada Maklumat</p>';
}
?>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	PENGISYTIHARAN
</div>
<table>
    <tr>
        <td>Saya dengan ini mengaku bahawa semua maklumat yang diberikan adalah tepat dan bahawa kerja-kerja dalam projek ini masih belum bermula.</td><td>:</td><td><?= ($model->pengisytiharan === 1)?'Ya':'Tidak' ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Tarikh") ?></td><td valign="top">:</td><td valign="top"><?= $model->tarikh_pengisytiharan ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	BORANG CADANGAN PENYELIDIKAN
</div>
<table>
    <tr>
        <td>Borang permohonan yang lengkap</td><td>:</td><td><?= ($model->semak_borang_permohonan_yang_lengkap != null)?'Ya':'Tidak' ?></td>
    </tr>
    <tr>
        <td>Carta Gantt</td><td>:</td><td><?= ($model->semak_carta_gantt != null)?'Ya':'Tidak' ?></td>
    </tr>
	<tr>
        <td>Carta aliran</td><td>:</td><td><?= ($model->semak_carta_aliran != null)?'Ya':'Tidak' ?></td>
    </tr>
    <tr>
        <td>Senarai rujukan kajian / bibliografi</td><td>:</td><td><?= ($model->semak_senarai_rujukan_kajian_bibliografi != null)?'Ya':'Tidak' ?></td>
    </tr>
	<tr>
        <td>CV ringkas pasukan penyelidikan (contohnya butir-butir peribadi, kelayakan akademik, kebanyakan penerbitan baru-baru ini, anugerah, pengalaman, dan lain-lain <2 muka surat)</td><td>:</td><td><?= ($model->semak_cv_ringkas_pasukan_penyelidikan != null)?'Ya':'Tidak' ?></td>
    </tr>
    <tr>
        <td>Salinan sebelum kelulusan etika</td><td>:</td><td><?= ($model->semak_salinan_sebelum_kelulusan_etika != null)?'Ya':'Tidak' ?></td>
    </tr>
	<tr>
        <td>Salinan cadangan penyelidikan penuh</td><td>:</td><td><?= ($model->semak_salinan_cadangan_penyelidikan_sepenuhnya != null)?'Ya':'Tidak' ?></td>
    </tr>
    <tr>
        <td>Salinan kunci maklumat</td><td>:</td><td><?= ($model->semak_salinan_kunci_maklumat != null)?'Ya':'Tidak' ?></td>
    </tr>
	<tr>
        <td>Salinan borang persetujuan</td><td>:</td><td><?= ($model->semak_salinan_borang_kebenaran != null)?'Ya':'Tidak' ?></td>
    </tr>
    <tr>
        <td>Semak Salinan Penepian Persetujuan</td><td>:</td><td><?= ($model->semak_salinan_penepian_persetujuan != null)?'Ya':'Tidak' ?></td>
    </tr>
	<tr>
        <td>Salinan surat pemberitahuan kepada ISN</td><td>:</td><td><?= ($model->semak_salinan_surat_pemberitahuan_kepada_isn != null)?'Ya':'Tidak' ?></td>
    </tr>
    <tr>
        <td>Salinan surat tawaran pengajian daripada institusi</td><td>:</td><td><?= ($model->semak_salinan_surat_tawaran_pengajian_daripada_institusi != null)?'Ya':'Tidak' ?></td>
    </tr>
	<tr>
        <td>Salinan dokumen sokongan</td><td>:</td><td><?= ($model->semak_salinan_dokumen_dokumen_sokongan != null)?'Ya':'Tidak' ?></td>
    </tr>
    <tr>
        <td>Salinan soal selidik</td><td>:</td><td><?= ($model->semak_salinan_soal_selidik != null)?'Ya':'Tidak' ?></td>
    </tr>
</table>

<hr />
<table>
    <tr>
        <td>Biasa Dengan Keperluan Penyelidikan</td><td>:</td><td><?= $model->biasa_dengan_keperluan_penyelidikan ?></td>
    </tr>
    <tr>
        <td>Kelulusan Etika</td><td>:</td><td><?= $model->kelulusan_echics ?></td>
    </tr>
	<tr>
        <td>Kelulusan</td><td>:</td><td><?= $model->kelulusan ?></td>
    </tr>
	<tr>
        <td>Tarikh Kelulusan</td><td>:</td><td><?= $model->tarikh_kelulusan ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	UNTUK KEGUNAAN PEJABAT SAHAJA
</div>
<table>
    <tr>
        <td>ISNRP No.</td><td>:</td><td><?= $model->isnrp_no ?></td>
    </tr>
	<tr>
        <td>Tarikh Direkod</td><td>:</td><td><?= $model->tarikh_direkodkan ?></td>
    </tr>
</table>
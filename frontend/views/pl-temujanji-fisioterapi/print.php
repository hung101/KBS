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
        <td><?= strtoupper("Kategori Pesakit") ?></td><td>:</td><td><?= $model->kategori_pesakit_luar ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Atlet") ?></td><td>:</td><td><?= $model->atlet_id ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Jenis Sukan") ?></td><td>:</td><td><?= $model->jenis_sukan ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Tarikh Temujanji") ?></td><td valign="top">:</td><td valign="top"><?= $model->tarikh_temujanji ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Kategori Rawatan") ?></td><td>:</td><td><?= $model->kategori_rawatan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Jenis Temujanji") ?></td><td>:</td><td><?= $model->makmal_perubatan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Status Temujanji") ?></td><td>:</td><td><?= $model->status_temujanji ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Tindakan Selanjutnya") ?></td><td>:</td><td><?= $model->tindakan_selanjutnya ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Pegawai Bertanggungjawab") ?></td><td>:</td><td><?= $model->nama_fisioterapi ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Pegawai Perubatan / Pakar Perubatan Sukan") ?></td><td>:</td><td><?= $model->pegawai_yang_bertanggungjawab ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Catatan Ringkas") ?></td><td valign="top">:</td><td valign="top"><?= $model->catitan_ringkas ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Maklum Balas") ?></td><td valign="top">:</td><td valign="top"><?= $model->maklumbalas ?></td>
    </tr>	
	<tr>
        <td><?= strtoupper("Muat Naik") ?></td><td>:</td><td><?= ($model->muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>	
</table>

<h4 class="text-underline"><?= strtoupper("Fisioterapi / Rehabilitasi Diagnosis") ?></h4>

<?php
if(count($PlDiagnosisPreskripsiPemeriksaanFisioterapi) > 0){
?>	
<table border="1" cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th align="center">BIL</th>
		<th><?= strtoupper("Bahagian Kecederaan") ?></th>
		<th><?= strtoupper("Fisioterapi / Rehabilitasi Diagnosis") ?></th>
		<th><?= strtoupper("Rawatan Fisioterapi / Rehabilitasi") ?></th>
		<th><?= strtoupper("Caj / Fi (RM)") ?></th>
	</tr>
	<?php
	$count = 1;
	$calculate_jumlah_caj_fi = 0.00;
	foreach($PlDiagnosisPreskripsiPemeriksaanFisioterapi as $item){
	?>
		<tr>
			<td align="center"><?= $count ?></td>
			<td><?= $item->refBahagianKecederaan->desc ?></td>
			<td><?= $item->status_diagnosis_preskripsi_pemeriksaan ?></td>
			<td><?= $item->refRawatanFisioterapi->desc ?></td>
			<td><?= number_format($item->harga, 2) ?></td>
		</tr>
	<?php
		$count++;
		$calculate_jumlah_caj_fi += $item->harga;
	}
	?>
</table>
<h4><?=GeneralLabel::jumlah_caj_fi?> : RM <?= number_format($calculate_jumlah_caj_fi, 2) ?></h4>
<?php
} else {
	echo '<p>Tiada Maklumat</p>';
}
?>
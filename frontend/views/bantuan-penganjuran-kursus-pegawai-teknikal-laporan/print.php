<table width="100%" border="1" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?></div><br />
			BAHAGIAN PENGURUSAN SUKAN<br/>
			CAWANGAN PENGURUSAN KEJOHANAN
		</td>
	</tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    MAKLUMAT KEJOHANAN / KURSUS
</div>

<table>
    <tr>
        <td>TARIKH MULA</td><td>:</td><td><?= ($model->tarikh != null)?date('d.m.Y', strtotime($model->tarikh)):null ?></td>
    </tr>
    <tr>
        <td>TARIKH TAMAT</td><td>:</td><td><?= ($model->tarikh != null)?date('d.m.Y', strtotime($model->tarikh_tamat)):null ?></td>
    </tr>
    <tr>
        <td>TEMPAT</td><td>:</td><td><?= $model->tempat ?></td>
    </tr>
    <tr>
        <td>NAMA KEJOHANAN</td><td>:</td><td><?= $model->tujuan_kursus_kejohanan ?></td>
    </tr>
    <tr>
        <td>BILANGAN PASUKAN</td><td>:</td><td><?= $model->bilangan_pasukan ?></td>
    </tr>
    <tr>
        <td>BILANGAN PESERTA</td><td>:</td><td><?= $model->bilangan_peserta ?></td>
    </tr>
	<tr>
        <td>BILANGAN PEGAWAI TEKNIKAL</td><td>:</td><td><?= $model->bilangan_pegawai_teknikal ?></td>
    </tr>
	<tr>
        <td>BILANGAN PEMBANTU</td><td>:</td><td><?= $model->bilangan_pembantu ?></td>
    </tr>
	<tr>
        <td>LAPORAN BERGAMBAR</td><td>:</td><td><?= ($model->laporan_bergambar != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>PENYATA PERBELANJAAN / RESIT YANG TELAH DISAHKAN</td><td>:</td><td><?= ($model->penyata_perbelanjaan_resit_yang_telah_disahkan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>JADUAL & KEPUTUSAN PERTANDINGAN</td><td>:</td><td><?= ($model->jadual_keputusan_pertandingan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>SENARAI PESERTA</td><td>:</td><td><?= ($model->senarai_peserta != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>STATISTIK PENYERTAAN</td><td>:</td><td><?= ($model->statistik_penyertaan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>SENARAI PEGAWAI PENCERAMAH</td><td>:</td><td><?= ($model->senarai_pegawai_penceramah != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>SENARAI URUSETIA / SUKARELAWAN</td><td>:</td><td><?= ($model->senarai_urusetia_sukarelawan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
</table>

<?php
if(count($BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan) > 0){
?>	
<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    <?= strtoupper("Tuntutan Baki Dua Puluh Peratus (20%) Daripada Jumlah Kelulusan") ?>
</div>
<table border="1" cellspacing="0" cellpadding="4">
    <tr>
        <th>BIL</th>
		<th><?= strtoupper("Kejohanan ATAU Kursus / Seminar / Bengkel") ?></th>
		<th>TARIKH MULA</th>
		<th>TARIKH TAMAT</th>
		<th>TEMPAT</th>
		<th>JUMLAH KELULUSAN (RM)</th>
		<th>PENDAHULUAN (80%)(RM)</th>
		<th>JUMLAH YANG DITUNTUT (20%)(RM)</th>
    </tr>
	<?php
	foreach($BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan as $key => $value)
	{
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['kejohanan_kursus_seminar_bengkel'] ?></td>
		<td><?= ($value['tarikh_mula'] != null)?date('d.m.Y', strtotime($value['tarikh_mula'])):null ?></td>
		<td><?= ($value['tarikh_tamat'] != null)?date('d.m.Y', strtotime($value['tarikh_tamat'])):null ?></td>
		<td><?= $value['tempat'] ?></td>
		<td><?= number_format($value['jumlah_kelulusan'], 2) ?></td>
		<td><?= number_format($value['pendahuluan_80'], 2) ?></td>
		<td><?= number_format($value['jumlah_yang_dituntut_20'], 2) ?></td>
	</tr>
	<?php
	}
	?>
</table>
<?php
}
?>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    AKUAN
</div>
<p>
Saya mengaku bahawa maklumat yang telah diisi seperti di atas adalah benar serta Majlis Sukan Negara berhak membatalkan sebarang kelulusan bantuan dan menuntut balik jumlah bantuan yang telah diberikan sekiranya didapati maklumat tersebut di atas adalah palsu.
</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="50%" style="border-right:1px solid">
			<b>Pemohon Bagi Pihak Badan Sukan</b><br /><br />
			Tandatangan: ____________________________________<br /><br />
			Nama : __________________________________________<br /><br />
			Tarikh : __________________________________________<br /><br /><br />
			Cop :<br /><br /><br />
		</td>
		<td width="50%" style="padding-left:5px">
			<b>Pengesahan Badan Sukan<br />(Jika ahli gabungan yang memohon)</b><br /><br />
			Tandatangan: ____________________________________<br /><br />
			Nama : __________________________________________<br /><br />
			Tarikh : __________________________________________<br /><br /><br />
			Cop :
		</td>
	</tr>
</table>

<div class="title-header-wrap" style="margin:40px 0px; padding:5px">
	TINDAKAN BAHAGIAN PENGURUSAN SUKAN MSN
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="50%" style="border-right:1px solid">
			<b>1) Penerimaan Pengarah Bahagian</b><br /><br />
			Tandatangan: ____________________________________<br /><br />
			Nama : __________________________________________<br /><br />
			Tarikh : __________________________________________<br /><br /><br />
			Catatan :<br /><br /><br />
		</td>
		<td width="50%" style="padding-left:5px">
			<b>2) Semakan Oleh Pegawai Bertanggungjawab</b><br /><br />
			Tandatangan: ____________________________________<br /><br />
			Nama : __________________________________________<br /><br />
			Jawatan : ________________________________________<br /><br /><br />
			Catatan :
		</td>
	</tr>
</table>
<br /><br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="70%">
			<b>3) TINDAKAN KERANI KEWANGAN BAHAGIAN PENGURUSAN SUKAN</b><br /><br />
			Nama : ______________________________________________<br /><br />
			JAWATAN : __________________________________________<br /><br /><br />
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="text-underline" style="width:45%">TINDAKAN</td><td class="text-underline">TARIKH</td></tr>
				<tr><td>KEW 7(No.______________________________)</td><td>:_________________</td></tr>
				<tr><td>ARAHAN BAYARAN(No._________________)</td><td>:_________________</td></tr>
				<tr><td>HANTAR KE KEWANGAN MAJLIS</td><td>:_________________</td></tr>
			</table>
		</td>
	</tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?></div><br />
			MAJLIS SUKAN NEGARA
		</td>
	</tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    MAKLUMAT KEJOHANAN / KURSUS
</div>

<table>
    <tr>
        <td>TARIKH</td><td>:</td><td><?= ($model->tarikh)?date('d.m.Y', strtotime($model->tarikh)):null ?></td>
    </tr>
	<tr>
        <td>TEMPAT</td><td>:</td><td><?= $model->tempat ?></td>
    </tr>
	<tr>
        <td>TUJUAN PENGANJURAN</td><td>:</td><td><?= $model->tujuan_penganjuran ?></td>
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
        <td><?= strtoupper("Penyata Perbelanjaan / Resit Yang Telah Disahkan") ?></td><td>:</td><td><?= ($model->penyata_perbelanjaan_resit_yang_telah_disahkan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Jadual & Keputusan Pertandingan") ?></td><td>:</td><td><?= ($model->jadual_keputusan_pertandingan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>SENARAI PASUKAN</td><td>:</td><td><?= ($model->senarai_pasukan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Senarai Statistik Penyertaan") ?></td><td>:</td><td><?= ($model->senarai_statistik_penyertaan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Senarai Pegawai / Pembantu Teknikal") ?></td><td>:</td><td><?= ($model->senarai_pegawai_pembantu_teknikal != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Senarai Urusetia / Sukarelawan") ?></td><td>:</td><td><?= ($model->senarai_urusetia_sukarelawan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Senarai Pegawai / Pembantu Perubatan") ?></td><td>:</td><td><?= ($model->senarai_pegawai_pembantu_perubatan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
</table>
<br />
<h4 class="text-underline"><?= strtoupper("Tuntutan Baki Dua Puluh Peratus (20%) Daripada Jumlah Kelulusan (Jika Ada)") ?></h4>
<?php
if(count($BantuanPenganjuranKejohananSirkitLaporanTuntutan) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>JUMLAH KELULUSAN(RM)</th>
			<th>PENDAHULUAN (80%)(RM)</th>
			<th>JUMLAH YANG DITUNTUT (20%)(RM)</th>
		</tr>
		<?php
		$count = 1;
		foreach($BantuanPenganjuranKejohananSirkitLaporanTuntutan as $item){
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= number_format($item->jumlah_kelulusan,2) ?></td>
				<td align="center"><?= number_format($item->pendahuluan_80,2) ?></td>
				<td align="center"><?= number_format($item->jumlah_yang_dituntut_20,2) ?></td>
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
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
    MAKLUMAT BADAN SUKAN
</div>

<table>
    <tr>
        <td>BADAN SUKAN</td><td>:</td><td><?= $model->badan_sukan ?></td>
    </tr>
    <tr>
        <td>SUKAN</td><td>:</td><td><?= $model->sukan ?></td>
    </tr>
    <tr>
        <td>NO PENDAFTARAN</td><td>:</td><td><?= $model->no_pendaftaran ?></td>
    </tr>
    <tr>
        <td valign="top">ALAMAT</td><td valign="top">:</td><td><?= ($model->alamat_1)?$model->alamat_1.'<br />':null ?><?= ($model->alamat_2)?$model->alamat_2.'<br />':null ?><?= ($model->alamat_3)?$model->alamat_3.'<br />':null ?></td>
    </tr>
    <tr>
        <td>POSKOD</td><td>:</td><td><?= $model->alamat_poskod ?></td>
    </tr>
    <tr>
        <td>BANDAR</td><td>:</td><td><?= $model->alamat_bandar ?></td>
    </tr>
    <tr>
        <td>NEGERI</td><td>:</td><td><?= $model->alamat_negeri ?></td>
    </tr>
	<tr>
        <td>NO. TELEFON</td><td>:</td><td><?= $model->no_telefon ?></td>
    </tr>
	<tr>
        <td>NO. FAKS</td><td>:</td><td><?= $model->no_faks ?></td>
    </tr>
	<tr>
        <td>LAMAN WEB</td><td>:</td><td><?= $model->laman_sesawang ?></td>
    </tr>
	<tr>
        <td>FACEBOOK</td><td>:</td><td><?= $model->facebook ?></td>
    </tr>
	<tr>
        <td>TWITTER</td><td>:</td><td><?= $model->twitter ?></td>
    </tr>
	<tr>
        <td>NAMA BANK</td><td>:</td><td><?= $model->nama_bank ?></td>
    </tr>
	<tr>
        <td>NO AKAUN</td><td>:</td><td><?= $model->no_akaun ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    MAKLUMAT KURSUS / SEMINAR / BENGKEL
</div>

<table>
    <tr>
        <td>NAMA KURSUS / SEMINAR / BENGKEL</td><td>:</td><td><?= $model->nama_kursus_seminar_bengkel ?></td>
    </tr>
    <tr>
        <td>TARIKH MULA</td><td>:</td><td><?= ($model->tarikh)?date('d.m.Y', strtotime($model->tarikh)):null ?></td>
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
        <td>YURAN PENYERTAAN</td><td>:</td><td>RM <?= $model->yuran_penyertaan ?></td>
    </tr>
	<tr>
        <td>SURAT RASMI BADAN SUKAN</td><td>:</td><td><?= ($model->surat_rasmi_badan_sukan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Surat Jemputan Daripada Pengelola") ?></td><td>:</td><td><?= ($model->surat_jemputan_daripada_pengelola != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>BUTIRAN PERBELANJAAN</td><td>:</td><td><?= ($model->butiran_perbelanjaan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>SALINAN PASSPORT</td><td>:</td><td><?= ($model->salinan_passport != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>MAKLUMAT LAIN (SOKONGAN)</td><td>:</td><td><?= ($model->maklumat_lain_sokongan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
</table>

<pagebreak />
<div class="text-underline text-bold" style="margin-bottom:10px"><?= strtoupper("Senarai Nama Pegawai Teknikal Yang Dicadangkan") ?></div>

<table border="1" cellspacing="0" cellpadding="4" width="100%">
	<tr>
		<th>BIL</th>
		<th>NAMA</th>
		<th>NAMA MAJIKAN</th>
		<th>JAWATAN</th>
	</tr>
	<?php
	foreach($BantuanPenganjuranKursusPegawaiTeknikalDicadangkan as $key => $value){
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['nama'] ?></td>
		<td><?= $value['nama_majikan'] ?></td>
		<td><?= $value['jawatan'] ?></td>
	</tr>
	<?php
	}
	?>
</table>
<br />

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    <?= strtoupper("Maklumat Kursus / Seminar / Bengkel Dalam Dan Luar Negara Yang Telah Disertai") ?>
</div>

<table border="1" cellspacing="0" cellpadding="4" width="100%">
	<tr>
		<th>BIL</th>
		<th>NAMA KURSUS / SEMINAR / BENGKEL</th>
		<th>TARIKH MULA</th>
		<th>TARIKH TAMAT</th>
		<th>TEMPAT</th>
		<th>ANJURAN</th>
	</tr>
	<?php
	foreach($BantuanPenganjuranKursusPegawaiTeknikalDisertai as $key => $value){
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['kursus_seminar_bengkel'] ?></td>
		<td><?= ($value['tarikh_mula'])?date('d.m.Y', strtotime($value['tarikh_mula'])):null ?></td>
		<td><?= ($value['tarikh_tamat'])?date('d.m.Y', strtotime($value['tarikh_tamat'])):null ?></td>
		<td><?= $value['tempat'] ?></td>
		<td><?= $value['anjuran'] ?></td>
	</tr>
	<?php
	}
	?>
</table>
<br />

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    <?= strtoupper("Bantuan Geran Penganjuran Kursus / Seminar / Bengkel Oleh MSN (Tahun Semasa & Tahun Sebelum)") ?>
</div>

<table border="1" cellspacing="0" cellpadding="4" width="100%">
	<tr>
		<th>BIL</th>
		<th>NAMA KURSUS / SEMINAR / BENGKEL</th>
		<th>TARIKH MULA</th>
		<th>TARIKH TAMAT</th>
		<th>TEMPAT</th>
		<th>JUMLAH BANTUAN (RM)</th>
		<th>LAPORAN DIKEMUKAKAN</th>
	</tr>
	<?php
	foreach($BantuanPenganjuranKursusPegawaiTeknikalOlehMsn as $key => $value){
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['kursus_seminar_bengkel'] ?></td>
		<td><?= ($value['tarikh_mula'])?date('d.m.Y', strtotime($value['tarikh_mula'])):null ?></td>
		<td><?= ($value['tarikh_tamat'])?date('d.m.Y', strtotime($value['tarikh_tamat'])):null ?></td>
		<td><?= $value['tempat'] ?></td>
		<td><?= $value['jumlah_bantuan'] ?></td>
		<td align="center"><?= $value['refKelulusan']['desc'] ?></td>
	</tr>
	<?php
	}
	?>
</table>
<br />

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    JUMLAH BANTUAN YANG DIPOHON
</div>

<table>
    <tr>
        <td>RM</td><td>:</td><td><?= $model->jumlah_bantuan_yang_dipohon ?></td>
    </tr>
</table>

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
	    <tr>
        <td>Surat Kelulusan</td><td>:</td><td><?= ($model->surat_kelulusan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
</table>

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
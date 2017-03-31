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
    MAKLUMAT KEJOHANAN
</div>

<table>
    <tr>
        <td>NAMA KEJOHANAN / PERTANDINGAN</td><td>:</td><td><?= $model->nama_kejohanan_pertandingan ?></td>
    </tr>
    <tr>
        <td>PERINGKAT</td><td>:</td><td><?= $model->peringkat ?></td>
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
        <td>BIL. PASUKAN</td><td>:</td><td><?= $model->bil_pasukan ?></td>
    </tr>
	<tr>
        <td>BIL. PESERTA</td><td>:</td><td><?= $model->bil_peserta ?></td>
    </tr>
	<tr>
        <td>BIL. PENGADIL/HAKIM</td><td>:</td><td><?= $model->bil_pengadil_hakim ?></td>
    </tr>
	<tr>
        <td>BIL. PEGAWAI TEKNIKAL</td><td>:</td><td><?= $model->bil_pegawai_teknikal ?></td>
    </tr>
	<tr>
        <td>BIL. PEMBANTU</td><td>:</td><td><?= $model->bilangan_pembantu ?></td>
    </tr>
	<tr>
        <td>ANGGARAN PERBELANJAAN (RM)</td><td>:</td><td><?= $model->anggaran_perbelanjaan ?></td>
    </tr>
	<tr>
        <td>KERTAS KERJA</td><td>:</td><td><?= ($model->kertas_kerja != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>SURAT RASMI / BADAN SUKAN / MS NEGERI</td><td>:</td><td><?= ($model->surat_rasmi_badan_sukan_ms_negeri != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>PERMOHONAN RASMI DARI AHLI GABUNGAN</td><td>:</td><td><?= ($model->permohonan_rasmi_dari_ahli_gabungan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td>MAKLUMAT LAIN (SOKONGAN)</td><td>:</td><td><?= ($model->maklumat_lain_sokongan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
</table>

<div class="text-underline text-bold" style="margin-bottom:10px">SUMBER-SUMBER KEWANGAN LAIN UNTUK KEJOHANAN / PERTANDINGAN</div>

<table border="1" cellspacing="0" cellpadding="4" width="100%">
	<tr>
		<th>BIL</th>
		<th>SUMBER KEWANGAN</th>
		<th>LAIN-LAIN</th>
		<th>JUMLAH (RM)</th>
	</tr>
	<?php
	$grandTotal = 0;
	foreach($BantuanPenganjuranKejohananKewangan as $key => $value){
		$grandTotal = $grandTotal+$value['jumlah'];
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['refSumberKewanganBantuanPenganjuranKejohanan']['desc'] ?></td>
		<td><?= $value['lain_lain'] ?></td>
		<td><?= $value['jumlah'] ?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="3" align="right" class="text-bold">JUMLAH</td>
		<td><?= number_format((float)$grandTotal, 2, '.', '') ?></td>
	</tr>
</table>
<br />
<div class="text-underline text-bold" style="margin-bottom:10px">BAYARAN PENYERTAAN KEJOHANAN / PERTANDINGAN YANG DIKENAKAN KEPADA PESERTA / PASUKAN</div>

<table border="1" cellspacing="0" cellpadding="4" width="100%">
	<tr>
		<th>BIL</th>
		<th>JENIS BAYARAN</th>
		<th>LAIN-LAIN</th>
		<th>JUMLAH (RM)</th>
	</tr>
	<?php
	$grandTotal = 0;
	foreach($BantuanPenganjuranKejohananBayaran as $key => $value){
		$grandTotal = $grandTotal+$value['jumlah'];
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['refJenisBayaranBantuanPenganjuranKejohanan']['desc'] ?></td>
		<td><?= $value['lain_lain'] ?></td>
		<td><?= $value['jumlah'] ?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="3" align="right" class="text-bold">JUMLAH</td>
		<td><?= number_format((float)$grandTotal, 2, '.', '') ?></td>
	</tr>
</table>
<br />

<div class="text-underline text-bold" style="margin-bottom:10px">ELEMEN BANTUAN YANG DIPOHON</div>

<table border="1" cellspacing="0" cellpadding="4" width="100%">
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
	$grandTotal = 0;
	foreach($BantuanPenganjuranKejohananElemen as $key => $value){
		$grandTotal = $grandTotal+$value['jumlah'];
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['refElemenBantuanPenganjuranKejohanan']['desc'] ?></td>
		<td><?= $value['refSubElemenBantuanPenganjuranKejohanan']['desc'] ?></td>
		<td><?= $value['kadar'] ?></td>
		<td align="center"><?= $value['bilangan'] ?></td>
		<td align="center"><?= $value['hari'] ?></td>
		<td><?= $value['jumlah'] ?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="6" align="right" class="text-bold">JUMLAH</td>
		<td><?= number_format((float)$grandTotal, 2, '.', '') ?></td>
	</tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    KEJOHANAN YANG TELAH DIANJUR (TAHUN SEMASA & TAHUN SEBELUM)
</div>

<table border="1" cellspacing="0" cellpadding="4" width="100%">
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
	foreach($BantuanPenganjuranKejohananDianjurkan as $key => $value){
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['kejohanan'] ?></td>
		<td align="center"><?= date('d.m.Y', strtotime($value['tarikh_mula'])) ?></td>
		<td align="center"><?= date('d.m.Y', strtotime($value['tarikh_tamat'])) ?></td>
		<td><?= $value['tempat'] ?></td>
		<td><?= $value['refPeringkatBantuanPenganjuranKejohananDianjurkan']['desc'] ?></td>
		<td><?= $value['jumlah'] ?></td>
	</tr>
	<?php
	}
	?>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    BANTUAN GERAN PENGANJURAN OLEH MSN (TAHUN SEMASA & TAHUN SEBELUM)
</div>

<table border="1" cellspacing="0" cellpadding="4" width="100%">
	<tr>
		<th>BIL</th>
		<th>KEJOHANAN</th>
		<th>TARIKH MULA</th>
		<th>TARIKH TAMAT</th>
		<th>TEMPAT</th>
		<th>PERINGKAT</th>
		<th>JUMLAH BANTUAN(RM)</th>
		<th>LAPORAN DIKEMUKAKAN</th>
	</tr>
	<?php
	foreach($BantuanPenganjuranKejohananOlehMsn as $key => $value){
	?>
	<tr>
		<td align="center"><?= $key+1 ?></td>
		<td><?= $value['kejohanan'] ?></td>
		<td align="center"><?= date('d.m.Y', strtotime($value['tarikh_mula'])) ?></td>
		<td align="center"><?= date('d.m.Y', strtotime($value['tarikh_tamat'])) ?></td>
		<td><?= $value['tempat'] ?></td>
		<td><?= $value['refPeringkatBantuanPenganjuranKejohananDianjurkan']['desc'] ?></td>
		<td><?= $value['jumlah_bantuan'] ?></td>
		<td><?= $value['refKelulusan']['desc'] ?></td>
	</tr>
	<?php
	}
	?>
</table>

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
<table align="center" width="70%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="right"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="90"></td>
        <td align="center"><b style="font-size:26px"><?= strtoupper($title) ?><br />MAJLIS SUKAN NEGARA</b></td>
    </tr>
</table>

<table style="margin-top:10px">
    <tr>
        <td>JURULATIH</td><td>:</td><td><?= $model->jurulatih ?></td>
    </tr>
    <tr>
        <td>PROGRAM</td><td>:</td><td><?= $model->program ?></td>
    </tr>
    <tr>
        <td>TARIKH MULA LANTIKAN</td><td>:</td><td><?= ($model->tarikh_mula_lantikan != null)?date('d-m-Y', strtotime($model->tarikh_mula_lantikan)):null ?></td>
    </tr>
    <tr>
        <td>TARIKH TAMAT LANTIKAN</td><td>:</td><td><?= ($model->tarikh_tamat_lantikan != null)?date('d-m-Y', strtotime($model->tarikh_tamat_lantikan)):null ?></td>
    </tr>
	<tr>
        <td>GAJI / ELAUN</td><td>:</td><td><?= $model->gaji_elaun ?></td>
    </tr>
    <tr>
        <td>JUMLAH (RM)</td><td>:</td><td><?= number_format($model->jumlah_gaji_elaun, 2) ?></td>
    </tr>
    <tr>
        <td>JENIS PERMOHONAN</td><td>:</td><td><?= $model->jenis_permohonan ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	<?= strtoupper("Cadangan Tempoh Kontrak") ?>
</div>

<table style="margin-top:10px">
    <tr>
        <td>TARIKH MULA</td><td>:</td><td><?= ($model->tarikh_mula != null)?date('d-m-Y', strtotime($model->tarikh_mula)):null ?></td>
    </tr>
    <tr>
        <td>TARIKH TAMAT</td><td>:</td><td><?= ($model->tarikh_tamat != null)?date('d-m-Y', strtotime($model->tarikh_tamat)):null ?></td>
    </tr>
	<tr>
        <td>PROGRAM BARU</td><td>:</td><td><?= $model->program_baru ?></td>
    </tr>
    <tr>
        <td>MUAT NAIK</td><td>:</td><td><?= ($model->muat_naik_cadangan != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	<?= strtoupper("Cadangan Elaun / Gaji") ?>
</div>

<table style="margin-top:10px">
	<tr>
        <td>GAJI / ELAUN</td><td>:</td><td><?= $model->cadangan_gaji_elaun ?></td>
    </tr>
	<tr>
        <td>JUMLAH (RM)</td><td>:</td><td><?= number_format($model->cadangan_jumlah_gaji_elaun, 2) ?></td>
    </tr>
	<tr>
        <td>SEBAB</td><td>:</td><td><?= $model->sebab ?></td>
    </tr>
	<tr>
        <td>PENAMATAN TARIKH BERKUATKUASA</td><td>:</td><td><?= ($model->penamatan_tarikh_berkuatkuasa != null)?date('d-m-Y', strtotime($model->penamatan_tarikh_berkuatkuasa)):null ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	MPJ
</div>

<table style="margin-top:10px">
	<tr>
        <td>TARIKH MPJ</td><td>:</td><td><?= ($model->tarikh_mpj != null)?date('d-m-Y', strtotime($model->tarikh_mpj)):null ?></td>
    </tr>
	<tr>
        <td>BILANGAN MPJ</td><td>:</td><td><?= $model->bil_mpj ?></td>
    </tr>
	<tr>
        <td>PENGERUSI</td><td>:</td><td><?= $model->pengerusi ?></td>
    </tr>
	<tr>
        <td valign="top">CATATAN</td><td valign="top">:</td><td valign="top"><?= $model->catatan_mpj ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
	JKB
</div>

<table style="margin-top:10px">
	<tr>
        <td>TARIKH JKB</td><td>:</td><td><?= ($model->tarikh_jkb != null)?date('d-m-Y', strtotime($model->tarikh_jkb)):null ?></td>
    </tr>
	<tr>
        <td>BILANGAN JKB</td><td>:</td><td><?= $model->bil_jkb ?></td>
    </tr>
	<tr>
        <td>KELULUSAN DKP</td><td>:</td><td><?= $model->kelulusan_dkp ?></td>
    </tr>
	<tr>
        <td valign="top">CATATAN</td><td valign="top">:</td><td valign="top"><?= $model->catatan_jkb ?></td>
    </tr>
</table>
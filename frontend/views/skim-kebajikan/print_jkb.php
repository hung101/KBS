<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
    <div class="form-title" style="margin:0px 0px 20px">
    PERMOHONAN JAWATANKUASA BANTUAN<br />
    BAHAGIAN ATLET<br />
    MAJLIS SUKAN NEGARA
    </div>
    
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
      <tr>
        <th rowspan="2" width="4%">BIL</th>
        <th rowspan="2" width="12%">AKTIVITI</th>
        <th rowspan="2" width="13%" align="left">I) TEMPAT<br>II) TARIKH<br>III) ATLET/PEG.<br>IV) LAIN-LAIN</th>
        <th colspan="3">PERMOHONAN</th>
        <th colspan="3">CADANGAN</th>
      </tr>
      <tr>
        <th width="20%">PERBELANJAAN DIPOHON</th>
        <th width="8%">JUMLAH</th>
        <th width="8%">CATATAN</th>
        <th width="20%">PERBELANJAAN DIPOHON</th>
        <th width="8%">JUMLAH</th>
        <th width="8%">CATATAN</th>
      </tr>
	<tr>
		<td align="center">1</td>
		<td>PERMOHONAN BANTUAN<br /><?= strtoupper($model->jenis_bantuan_skak) ?><br /><br />Atlet:<br /><?= strtoupper($model->nama_pemohon) ?></td>
		<td valign="top">I)<br />II)<br />1/0 orang<br />0 orang</td>
		<td valign="top">SKIM KEBAJIKAN ATLET<br />KEBANGSAAN(SKAK)<br /><?= strtoupper($model->nama_pemohon) ?> (<?= strtoupper($model->jenis_sukan) ?>)<br />(<?= strtoupper($model->nama_penerima) ?>)</td>
		<td valign="bottom"><?= number_format($model->jumlah_bantuan, 2) ?></td>
		<td rowspan="2">&nbsp;</td>
		<td valign="top">SKIM KEBAJIKAN ATLET<br />KEBANGSAAN(SKAK)<br /><?= strtoupper($model->nama_pemohon) ?> (<?= strtoupper($model->jenis_sukan) ?>)</td>
		<td valign="bottom"><?= number_format($model->jumlah_bantuan, 2) ?></td>
		<td valign="top" rowspan="2"><?= $model->catatan ?></td>
	</tr>
	<tr>
		<td colspan="4" align="right"><b>JUMLAH (RM)</b></td>
		<td><?= number_format($model->jumlah_bantuan, 2) ?></td>
		<td align="right"><b>JUMLAH (RM)</b></td>
		<td><?= number_format($model->jumlah_bantuan, 2) ?></td>
	</tr>
    </table>
</body>
</html>
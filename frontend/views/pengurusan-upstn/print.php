<table width="100%" border="1" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?></div><br />
			LAPORAN PELAKSAAN<br/>
			PEGAWAI PEMBANGUNAN NEGERI (SDO)<br/>
                        UNIT SUKAN PRESTASI TINGGI NEGERI (USPTN)
		</td>
	</tr>
</table>
<table>
    <tr>
        <td >TARIKH PEMANTAUAN</td><td >:</td><td ><?= ($model->tarikh_lawatan)?date('d.m.Y', strtotime($model->tarikh_lawatan)):null ?></td>
        <td style="padding-left:80px">MASA</td><td >:</td><td><?= ($model->tarikh_lawatan)?date('g:i A', strtotime($model->tarikh_lawatan)):null ?></td>
    </tr>
    <tr>
        <td>SUKAN</td><td>:</td><td colspan="4"><?= $model->nama_sukan ?></td>
    </tr>
    <tr>
        <td>NEGERI</td><td>:</td><td colspan="4"><?= $model->negeri ?></td>
    </tr>
    <tr>
        <td>NAMA</td><td>:</td><td colspan="4"><?= $model->nama_pengurus_sukan ?></td>
    </tr>
</table>
<br>
<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    ATLET
</div>
<section>
<h4>Pecahan Umur</h4>
<table width="70%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
                <th>KATEGORI</th>
                <th>LELAKI</th>
                <th>WANITA</th>
                <th>JUMLAH</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">U 12</td>
            <td align="center"><?= $model->u12_lelaki ?></td>
            <td align="center"><?= $model->u12_wanita ?></td>
            <td align="center"><?= ($model->u12_lelaki + $model->u12_wanita) ?></td>
        </tr>
        <tr>
            <td align="center">U 15</td>
            <td align="center"><?= $model->u15_lelaki ?></td>
            <td align="center"><?= $model->u15_wanita ?></td>
            <td align="center"><?= ($model->u15_lelaki + $model->u15_wanita) ?></td>
        </tr>
        <tr>
            <td align="center">U 18</td>
            <td align="center"><?= $model->u18_lelaki ?></td>
            <td align="center"><?= $model->u18_wanita ?></td>
            <td align="center"><?= ($model->u18_lelaki + $model->u18_wanita) ?></td>
        </tr>
        <tr>
            <td align="center">U 21</td>
            <td align="center"><?= $model->u21_lelaki ?></td>
            <td align="center"><?= $model->u21_wanita ?></td>
            <td align="center"><?= ($model->u21_lelaki + $model->u21_wanita) ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr style="font-weight:bold">
            <td align="center">JUMLAH</td>
            <td align="center"><?= ($model->u12_lelaki + $model->u15_lelaki + $model->u18_lelaki + $model->u21_lelaki) ?></td>
            <td align="center"><?= ($model->u12_wanita + $model->u15_wanita + $model->u18_wanita + $model->u21_wanita) ?></td>
            <td align="center"><?= ($model->u12_lelaki + $model->u15_lelaki + $model->u18_lelaki + $model->u21_lelaki +
                    $model->u12_wanita + $model->u15_wanita + $model->u18_wanita + $model->u21_wanita) ?></td>
        </tr>
  </tfoot>
</table>
<br>
</section>

<section>
<h4>Pecahan Kaum</h4>
<table width="70%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
                <th>KAUM</th>
                <th>LELAKI</th>
                <th>WANITA</th>
                <th>JUMLAH</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">MELAYU</td>
            <td align="center"><?= $model->l_melayu ?></td>
            <td align="center"><?= $model->w_melayu ?></td>
            <td align="center"><?= ($model->l_melayu + $model->w_melayu) ?></td>
        </tr>
        <tr>
            <td align="center">CINA</td>
            <td align="center"><?= $model->l_cina ?></td>
            <td align="center"><?= $model->w_cina ?></td>
            <td align="center"><?= ($model->l_cina + $model->w_cina) ?></td>
        </tr>
        <tr>
            <td align="center">INDIA</td>
            <td align="center"><?= $model->l_india ?></td>
            <td align="center"><?= $model->w_india ?></td>
            <td align="center"><?= ($model->l_india + $model->w_india) ?></td>
        </tr>
        <tr>
            <td align="center">LAIN-LAIN</td>
            <td align="center"><?= $model->l_lain_lain ?></td>
            <td align="center"><?= $model->w_lain_lain ?></td>
            <td align="center"><?= ($model->l_lain_lain + $model->w_lain_lain) ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr style="font-weight:bold">
            <td align="center">JUMLAH</td>
            <td align="center"><?= ($model->l_melayu + $model->l_cina + $model->l_india + $model->l_lain_lain) ?></td>
            <td align="center"><?= ($model->w_melayu + $model->w_cina + $model->w_india + $model->w_lain_lain) ?></td>
            <td align="center"><?= ($model->l_melayu + $model->l_cina + $model->l_india + $model->l_lain_lain +
                    $model->w_melayu + $model->w_cina + $model->w_india + $model->w_lain_lain) ?></td>
        </tr>
  </tfoot>
</table>
<br>
</section>

<section>
<h4>MESYUARAT/PERJUMPAAN JURULATIH</h4>
<table width="70%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>BIL</th>
            <th>TARIKH</th>
            <th>TEMPAT</th>
            <th>PESERTA</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1;
            foreach($PengurusanUpstnJurulatih as $item){

            ?>
                    <tr>
                            <td align="center"><?= $count ?></td>
                            <td align="center"><?= ($item->tarikh)?date('d.m.Y', strtotime($item->tarikh)):null ?></td>
                            <td align="center"><?= $item->tempat ?></td>
                            <td align="center"><?= $item->peserta ?></td>
                    </tr>
            <?php
                    $count++;
            }
            ?>
    </tbody>
</table>
<br>
</section>

<section>
<h4>PERJUMPAAN ATLET</h4>
<table width="70%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>BIL</th>
            <th>TARIKH</th>
            <th>TEMPAT</th>
            <th>PESERTA</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1;
            foreach($PengurusanUpstnAtlet as $item){

            ?>
                    <tr>
                            <td align="center"><?= $count ?></td>
                            <td align="center"><?= ($item->tarikh)?date('d.m.Y', strtotime($item->tarikh)):null ?></td>
                            <td align="center"><?= $item->tempat ?></td>
                            <td align="center"><?= $item->peserta ?></td>
                    </tr>
            <?php
                    $count++;
            }
            ?>
    </tbody>
</table>
<br>
</section>

<?php
// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
?>

<div class="float-left" style="width:14%">
    <img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="">
</div>
<div class="float-left form-title-center" style="width:80%">
    LAPORAN PENGANJURAN/PENYERTAAN
</div>
<div class="clear"></div>

<table style="margin-top:20px">
    <tr>
        <td>NEGERI</td><td>:</td><td><?= $model->negeri ?></td>
    </tr>
    <tr>
        <td>SUKAN</td><td>:</td><td><?= $model->sukan ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
    MAKLUMAT AKTIVITI
</div>

<table>
    <tr>
        <td><?= GeneralLabel::jenis_laporan ?></td><td>:</td><td><?= $model->jenis_laporan ?></td>
    </tr>
    <tr>
        <td><?= GeneralLabel::aktiviti ?></td><td>:</td><td><?= $model->aktiviti ?></td>
    </tr>
    <tr>
        <td><?= GeneralLabel::tahap ?></td><td>:</td><td><?= $model->tahap ?></td>
    </tr>
    <tr>
        <td><?= GeneralLabel::jenis_aktiviti ?></td><td>:</td><td><?= $model->jenis_aktiviti ?></td>
    </tr>
    <tr>
        <td><?= GeneralLabel::tempat ?></td><td>:</td><td><?= $model->tempat ?></td>
    </tr>
    <tr>
        <td><?= GeneralLabel::tarikh ?></td><td>:</td><td><?= $model->tarikh_mula ?> - <?= $model->tarikh_tamat ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
    MAKLUMAT PESERTA
</div>

<table border="0" width="90%" cellpadding="4" cellspacing="10" align="center">
    <tr>
        <td></th>
        <td style="text-align:center">Atlet</td>
        <td style="text-align:center">Jurulatih</td>
        <td style="text-align:center">Pegawai</td>
        <td style="text-align:center">Teknikal</td>
        <td style="text-align:center">Urusetia</td>
        <th style="text-align:center">JUMLAH</th>
    </tr>
    <tr>
        <td style="text-align:center">Lelaki</td>
        <td style="text-align:center" class="solid"><?= $model->atlet_lelaki ?></td>
        <td style="text-align:center" class="solid"><?= $model->jurulatih_lelaki ?></td>
        <td style="text-align:center" class="solid"><?= $model->pegawai_lelaki ?></td>
        <td style="text-align:center" class="solid"><?= $model->teknikal_lelaki ?></td>
        <td style="text-align:center" class="solid"><?= $model->urusetia_lelaki ?></td>
        <td style="text-align:center" class="solid2"><?= $totalLelaki = $model->atlet_lelaki+$model->jurulatih_lelaki+$model->pegawai_lelaki+$model->teknikal_lelaki+$model->urusetia_lelaki ?></td>
    </tr>
    <tr>
        <td style="text-align:center">Wanita</td>        
        <td style="text-align:center" class="solid"><?= $model->atlet_perempuan ?></td>
        <td style="text-align:center" class="solid"><?= $model->jurulatih_perempuan ?></td>
        <td style="text-align:center" class="solid"><?= $model->pegawai_perempuan ?></td>
        <td style="text-align:center" class="solid"><?= $model->teknikal_perempuan ?></td>
        <td style="text-align:center" class="solid"><?= $model->urusetia_perempuan ?></td>
        <td style="text-align:center" class="solid2"><?= $totalPerempuan = $model->atlet_perempuan+$model->jurulatih_perempuan+$model->pegawai_perempuan+$model->teknikal_perempuan+$model->urusetia_perempuan ?></td>
    </tr>
    <tr>
        <td style="text-align:center; font-weight:bold">JUMLAH</td>
        <td style="text-align:center" class="solid2"><?= $model->atlet_lelaki+$model->atlet_perempuan ?></td>
        <td style="text-align:center" class="solid2"><?= $model->jurulatih_lelaki+$model->jurulatih_perempuan ?></td>
        <td style="text-align:center" class="solid2"><?= $model->pegawai_lelaki+$model->pegawai_perempuan ?></td>
        <td style="text-align:center" class="solid2"><?= $model->teknikal_lelaki+$model->teknikal_perempuan ?></td>
        <td style="text-align:center" class="solid2"><?= $model->urusetia_lelaki+$model->urusetia_perempuan ?></td>
        <td style="text-align:center" class="solid2"><?= $totalLelaki+$totalPerempuan ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
    MAKLUMAT PERBELANJAAN
</div>

<table border="0" width="100%" cellpadding="4" cellspacing="10" align="center">
  <tr>
    <th></th>
    <th></th>
    <th style="text-align:center">MSN</th>
    <th style="text-align:center">MS NEGERI/PSN</th>
  </tr>
  <tr>
    <td><?= GeneralLabel::peruntukan_dipohon ?></td>
    <td align="right" style="font-weight:bold">RM</td>
    <td style="padding:0px 20px" class="solid"><?= $model->peruntukan_dipohon_msn ?></td>
    <td style="padding:0px 0px 0px 20px" class="solid"><?= $model->peruntukan_dipohon_psn ?></td>
  </tr>
  <tr>
    <td><?= GeneralLabel::peruntukan_dilulus ?></td>
    <td align="right" style="font-weight:bold">RM</td>
    <td style="padding:0px 20px" class="solid"><?= $model->peruntukan_dilulus_msn ?></td>
    <td style="padding:0px 0px 0px 20px" class="solid"><?= $model->peruntukan_dilulus_psn ?></td>
  </tr>
  <tr>
    <td><?= GeneralLabel::jumlah_diterima ?></td>
    <td align="right" style="font-weight:bold">RM</td>
    <td style="padding:0px 20px" class="solid"><?= $model->jumlah_diterima_msn ?></td>
    <td style="padding:0px 0px 0px 20px" class="solid"><?= $model->jumlah_diterima_psn ?></td>
  </tr>
  <tr>
    <td><?= GeneralLabel::jumlah_perbelanjaan ?></td>
    <td align="right" style="font-weight:bold">RM</td>
    <td colspan="2" style="padding:0px 0px 0px 20px" class="solid"><?= $model->jumlah_perbelanjaan ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold"><?= GeneralLabel::perbelanjaan_sebenar ?></td>
    <td align="right" style="font-weight:bold">RM</td>
    <td colspan="2" style="padding:0px 0px 0px 20px" class="solid2"><?= $model->perbelanjaan_sebenar ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold"><?= GeneralLabel::baki_dituntut ?></td>
    <td align="right" style="font-weight:bold">RM</td>
    <td colspan="2" style="padding:0px 0px 0px 20px" class="solid2"><?= $model->baki_dituntut ?></td>
  </tr>
</table>
<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikal */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::bantuan_penyertaan_pegawai_teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penyertaan_pegawai_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penyertaan_pegawai_teknikal, 'url' => ['view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penyertaan-pegawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
        'dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
        'searchModelBantuanPenyertaanPegawaiTeknikalDisertai' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
        'dataProviderBantuanPenyertaanPegawaiTeknikalDisertai' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
        'searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
        'dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursus */

$this->title = 'Update Bantuan Penganjuran Kursus: ' . $model->bantuan_penganjuran_kursus_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kursus_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kursus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
        'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
        'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
        'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
        'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
        'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
        'readonly' => $readonly,
    ]) ?>

</div>

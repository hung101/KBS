<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursus */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanPenganjuranKursusPenceramah' => $searchModelBantuanPenganjuranKursusPenceramah,
        'dataProviderBantuanPenganjuranKursusPenceramah' => $dataProviderBantuanPenganjuranKursusPenceramah,
        'searchModelBantuanPenganjuranKursusDisertaiPenceramah' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
        'dataProviderBantuanPenganjuranKursusDisertaiPenceramah' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
        'searchModelBantuanPenganjuranKursusOlehMsn' => $searchModelBantuanPenganjuranKursusOlehMsn,
        'dataProviderBantuanPenganjuranKursusOlehMsn' => $dataProviderBantuanPenganjuranKursusOlehMsn,
        'searchModelBantuanPenganjuranKursusElemen' => $searchModelBantuanPenganjuranKursusElemen,
        'dataProviderBantuanPenganjuranKursusElemen' => $dataProviderBantuanPenganjuranKursusElemen,
        'readonly' => $readonly,
    ]) ?>

</div>

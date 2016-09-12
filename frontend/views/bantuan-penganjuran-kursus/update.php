<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursus */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_id]];
$this->params['breadcrumbs'][] = $this->title;
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

<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\GajiDanElaunJurulatih */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::gaji_dan_elaun_jurulatih.': ' . ' ' . $model->gaji_dan_elaun_jurulatih_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::gaji_dan_elaun_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::gaji_dan_elaun_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::gaji_dan_elaun_jurulatih, 'url' => ['view', 'id' => $model->gaji_dan_elaun_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-dan-elaun-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
        'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
        'searchModelGajiJurulatih' => $searchModelGajiJurulatih,
        'dataProviderGajiJurulatih' => $dataProviderGajiJurulatih,
        'readonly' => $readonly,
    ]) ?>

</div>

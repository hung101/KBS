<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\GajiDanElaunJurulatih */

//$this->title = 'Update Gaji Dan Elaun Jurulatih: ' . ' ' . $model->gaji_dan_elaun_jurulatih_id;
$this->title = GeneralLabel::updateTitle . ' Gaji Dan Elaun Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Gaji Dan Elaun Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Gaji Dan Elaun Jurulatih', 'url' => ['view', 'id' => $model->gaji_dan_elaun_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-dan-elaun-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
        'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
        'readonly' => $readonly,
    ]) ?>

</div>

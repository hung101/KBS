<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKursuskem */

//$this->title = 'Update Atlet Pembangunan Kursuskem: ' . ' ' . $model->kursus_kem_id;
$this->title = GeneralLabel::updateTitle . ' Kursus/Kem';
$this->params['breadcrumbs'][] = ['label' => 'Kursus/Kem', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Kursus/Kem', 'url' => ['view', 'id' => $model->kursus_kem_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pembangunan-kursuskem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

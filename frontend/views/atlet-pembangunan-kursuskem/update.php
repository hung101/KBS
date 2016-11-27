<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKursuskem */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_pembangunan_kursuskem.': ' . ' ' . $model->kursus_kem_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::kursuskem;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kursuskem, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::kursuskem, 'url' => ['view', 'id' => $model->kursus_kem_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pembangunan-kursuskem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

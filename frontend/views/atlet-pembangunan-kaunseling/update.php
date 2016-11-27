<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKaunseling */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_pembangunan_kaunseling.': ' . ' ' . $model->kaunseling_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::kaunseling;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kaunseling, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::kaunseling, 'url' => ['view', 'id' => $model->kaunseling_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pembangunan-kaunseling-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

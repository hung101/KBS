<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanInsurans */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_perubatan_insurans.': ' . ' ' . $model->insurans_id;
$this->title = GeneralLabel::updateTitle . ' Insurans';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::insurans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Insurans', 'url' => ['view', 'id' => $model->insurans_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-insurans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

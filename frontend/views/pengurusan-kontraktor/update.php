<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKontraktor */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_kontraktor.': ' . ' ' . $model->pengurusan_kontraktor_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Kontraktor';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kontraktor, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Kontraktor', 'url' => ['view', 'id' => $model->pengurusan_kontraktor_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kontraktor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

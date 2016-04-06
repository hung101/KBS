<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTugas */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_tugas;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_tugas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-tugas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Satelit */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::satelit.': ' . ' ' . $model->satelit_id;
$this->title = GeneralLabel::updateTitle;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::laporan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->satelit_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satelit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

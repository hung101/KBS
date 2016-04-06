<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJkkJkpBajet */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_jkk_jkp_bajet.': ' . ' ' . $model->pengurusan_jkk_jkp_bajet_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_jkkjkp_bajet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jkkjkp_bajet, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_jkkjkp_bajet, 'url' => ['view', 'id' => $model->pengurusan_jkk_jkp_bajet_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jkk-jkp-bajet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

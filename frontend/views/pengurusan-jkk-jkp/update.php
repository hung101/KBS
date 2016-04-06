<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJkkJkp */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_jkk_jkp.': ' . ' ' . $model->pengurusan_jkk_jkp_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_jkkjkp;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jkkjkp, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_jkkjkp, 'url' => ['view', 'id' => $model->pengurusan_jkk_jkp_id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="pengurusan-jkk-jkp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

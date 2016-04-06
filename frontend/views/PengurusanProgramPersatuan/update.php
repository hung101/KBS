<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramPersatuan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_program_persatuan.': ' . ' ' . $model->pengurusan_program_persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_program_persatuan, 'url' => ['view', 'id' => $model->pengurusan_program_persatuan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-persatuan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

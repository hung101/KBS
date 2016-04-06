<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RehabilitasiProgram */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::rehabilitasi_program.': ' . ' ' . $model->rehabilitasi_program_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::rehabilitasi_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rehabilitasi_program_id, 'url' => ['view', 'id' => $model->rehabilitasi_program_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rehabilitasi-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

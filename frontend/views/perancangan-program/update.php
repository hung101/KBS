<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerancanganProgram */

//$this->title = 'Update Perancangan Program: ' . ' ' . $model->perancangan_program_id;
$this->title = GeneralLabel::updateTitle . ' Program';
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Program', 'url' => ['view', 'id' => $model->perancangan_program_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perancangan-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

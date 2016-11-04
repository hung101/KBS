<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefProgramPengawaiTeknikal */

$this->title = 'Update Ref Program Pengawai Teknikal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Program Pengawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-program-pengawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

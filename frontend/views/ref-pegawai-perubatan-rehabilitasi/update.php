<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPerubatanRehabilitasi */

$this->title = 'Update Ref Pegawai Perubatan Rehabilitasi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Perubatan Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-pegawai-perubatan-rehabilitasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

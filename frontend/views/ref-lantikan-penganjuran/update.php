<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefLantikanPenganjuran */

$this->title = 'Update Ref Lantikan Penganjuran: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Lantikan Penganjurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-lantikan-penganjuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

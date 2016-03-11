<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPasukanPenyelidikan */

$this->title = 'Update Ref Pasukan Penyelidikan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Pasukan Penyelidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-pasukan-penyelidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

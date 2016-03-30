<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanPasukanPenyelidikan */

$this->title = 'Update Ref Jawatan Pasukan Penyelidikan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Pasukan Penyelidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jawatan-pasukan-penyelidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

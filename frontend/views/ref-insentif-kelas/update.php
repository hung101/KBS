<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefInsentifKelas */

$this->title = 'Update Ref Insentif Kelas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Insentif Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-insentif-kelas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

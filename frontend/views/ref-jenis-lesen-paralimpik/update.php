<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisLesenParalimpik */

$this->title = 'Update Ref Jenis Lesen Paralimpik: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Lesen Paralimpiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-lesen-paralimpik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKejohananPencapaian */

$this->title = 'Update Ref Kejohanan Pencapaian: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kejohanan Pencapaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kejohanan-pencapaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

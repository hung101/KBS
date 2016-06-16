<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefTahapKpsk */

$this->title = 'Update Ref Tahap Kpsk: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Kpsks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-tahap-kpsk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
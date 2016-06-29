<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefTujuanUjianFisiologiSub */

$this->title = 'Update Ref Tujuan Ujian Fisiologi Sub: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Tujuan Ujian Fisiologi Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-tujuan-ujian-fisiologi-sub-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

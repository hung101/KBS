<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSukan */

$this->title = 'Update Ref Sukan: ' . ' ' . $model->ref_sukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ref_sukan_id, 'url' => ['view', 'id' => $model->ref_sukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

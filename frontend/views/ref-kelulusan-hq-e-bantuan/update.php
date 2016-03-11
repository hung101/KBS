<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanHqEBantuan */

$this->title = 'Update Ref Kelulusan Hq Ebantuan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Hq Ebantuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kelulusan-hq-ebantuan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

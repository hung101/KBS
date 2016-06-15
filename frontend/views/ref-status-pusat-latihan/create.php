<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPusatLatihan */

$this->title = 'Create Ref Status Pusat Latihan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Pusat Latihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-pusat-latihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

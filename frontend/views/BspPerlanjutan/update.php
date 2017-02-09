<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutan */

$this->title = 'Update Bsp Perlanjutan: ' . ' ' . $model->bsp_perlanjutan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Perlanjutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_perlanjutan_id, 'url' => ['view', 'id' => $model->bsp_perlanjutan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-perlanjutan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

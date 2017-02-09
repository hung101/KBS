<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPenjamin */

$this->title = 'Update Bsp Penjamin: ' . ' ' . $model->bsp_penjamin_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Penjamins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_penjamin_id, 'url' => ['view', 'id' => $model->bsp_penjamin_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-penjamin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspBorang11 */

$this->title = 'Update Bsp Borang11: ' . ' ' . $model->bsp_borang_11_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Borang11s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_borang_11_id, 'url' => ['view', 'id' => $model->bsp_borang_11_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-borang11-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

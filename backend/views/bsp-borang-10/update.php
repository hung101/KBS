<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspBorang10 */

$this->title = 'Update Bsp Borang10: ' . ' ' . $model->bsp_borang_10_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Borang10s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_borang_10_id, 'url' => ['view', 'id' => $model->bsp_borang_10_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-borang10-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

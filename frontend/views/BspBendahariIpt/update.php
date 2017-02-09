<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

$this->title = 'Update Bsp Bendahari Ipt: ' . ' ' . $model->bsp_bendahari_ipt_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Bendahari Ipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_bendahari_ipt_id, 'url' => ['view', 'id' => $model->bsp_bendahari_ipt_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-bendahari-ipt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

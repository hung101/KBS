<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanSebab */

$this->title = 'Update Bsp Perlanjutan Sebab: ' . ' ' . $model->bsp_perlanjutan_sebab_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Perlanjutan Sebabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_perlanjutan_sebab_id, 'url' => ['view', 'id' => $model->bsp_perlanjutan_sebab_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-perlanjutan-sebab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

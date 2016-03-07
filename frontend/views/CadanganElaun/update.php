<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CadanganElaun */

$this->title = 'Update Cadangan Elaun: ' . ' ' . $model->cadangan_elaun_id;
$this->params['breadcrumbs'][] = ['label' => 'Cadangan Elauns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cadangan_elaun_id, 'url' => ['view', 'id' => $model->cadangan_elaun_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cadangan-elaun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

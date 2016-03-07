<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SoalanPenilaian */

$this->title = 'Update Soalan Penilaian: ' . ' ' . $model->soalan_penilaian_id;
$this->params['breadcrumbs'][] = ['label' => 'Soalan Penilaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->soalan_penilaian_id, 'url' => ['view', 'id' => $model->soalan_penilaian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soalan-penilaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

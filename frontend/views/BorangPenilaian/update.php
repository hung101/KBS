<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaian */

$this->title = 'Update Borang Penilaian: ' . ' ' . $model->borang_penilaian_id;
$this->params['breadcrumbs'][] = ['label' => 'Borang Penilaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borang_penilaian_id, 'url' => ['view', 'id' => $model->borang_penilaian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borang-penilaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

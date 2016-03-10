<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeralatanPermohonanMembaiki */

$this->title = 'Update Ref Peralatan Permohonan Membaiki: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Peralatan Permohonan Membaikis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-peralatan-permohonan-membaiki-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

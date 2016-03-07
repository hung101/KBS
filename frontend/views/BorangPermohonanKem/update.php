<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPermohonanKem */

$this->title = 'Update Borang Permohonan Kem: ' . ' ' . $model->borang_permohonan_kem_id;
$this->params['breadcrumbs'][] = ['label' => 'Borang Permohonan Kems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borang_permohonan_kem_id, 'url' => ['view', 'id' => $model->borang_permohonan_kem_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borang-permohonan-kem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

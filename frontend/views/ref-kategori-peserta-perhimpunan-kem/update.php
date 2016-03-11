<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPesertaPerhimpunanKem */

$this->title = 'Update Ref Kategori Peserta Perhimpunan Kem: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Peserta Perhimpunan Kems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-peserta-perhimpunan-kem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

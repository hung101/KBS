<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPencalonanPasukan */

$this->title = 'Update Ref Kategori Pencalonan Pasukan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pencalonan Pasukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-pencalonan-pasukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

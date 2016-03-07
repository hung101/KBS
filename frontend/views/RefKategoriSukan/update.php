<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriSukan */

$this->title = 'Update Ref Kategori Sukan: ' . ' ' . $model->ref_kategori_sukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ref_kategori_sukan_id, 'url' => ['view', 'id' => $model->ref_kategori_sukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

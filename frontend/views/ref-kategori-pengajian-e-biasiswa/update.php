<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPengajianEBiasiswa */

$this->title = 'Update Ref Kategori Pengajian Ebiasiswa: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pengajian Ebiasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-pengajian-ebiasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubKategoriPenilaianJurulatihKetua */

$this->title = 'Update Ref Sub Kategori Penilaian Jurulatih Ketua: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sub Kategori Penilaian Jurulatih Ketuas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sub-kategori-penilaian-jurulatih-ketua-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
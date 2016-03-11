<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAduanPenyertaanSukan */

$this->title = 'Update Ref Kategori Aduan Penyertaan Sukan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Aduan Penyertaan Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kategori-aduan-penyertaan-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

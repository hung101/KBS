<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriMakananTambahan */

$this->title = 'Create Ref Kategori Makanan Tambahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Makanan Tambahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-makanan-tambahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

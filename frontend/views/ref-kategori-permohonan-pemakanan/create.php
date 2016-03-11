<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPermohonanPemakanan */

$this->title = 'Create Ref Kategori Permohonan Pemakanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Permohonan Pemakanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-permohonan-pemakanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

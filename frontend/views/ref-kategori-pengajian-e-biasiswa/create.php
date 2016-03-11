<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPengajianEBiasiswa */

$this->title = 'Create Ref Kategori Pengajian Ebiasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Pengajian Ebiasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pengajian-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriSoalanPeserta */

$this->title = 'Create Ref Kategori Soalan Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Soalan Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-soalan-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

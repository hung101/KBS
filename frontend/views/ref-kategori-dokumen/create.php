<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriDokumen */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Dokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-dokumen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

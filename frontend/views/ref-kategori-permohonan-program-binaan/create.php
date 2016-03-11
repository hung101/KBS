<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPermohonanProgramBinaan */

$this->title = 'Create Ref Kategori Permohonan Program Binaan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Permohonan Program Binaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-permohonan-program-binaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriMasalahKaunseling */

$this->title = 'Create Ref Kategori Masalah Kaunseling';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Masalah Kaunselings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-masalah-kaunseling-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

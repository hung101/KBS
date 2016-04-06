<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriMasalahKaunseling */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_masalah_kaunseling;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_masalah_kaunseling, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-masalah-kaunseling-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

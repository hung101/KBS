<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPerbelanjaanSukan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_perbelanjaan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_perbelanjaan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-perbelanjaan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

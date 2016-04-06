<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPesertaPerhimpunanKem */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_peserta_perhimpunan_kem;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_peserta_perhimpunan_kem, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-peserta-perhimpunan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

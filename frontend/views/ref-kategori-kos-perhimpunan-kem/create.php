<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKosPerhimpunanKem */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_kos_perhimpunan_kem;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_kos_perhimpunan_kem, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kos-perhimpunan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

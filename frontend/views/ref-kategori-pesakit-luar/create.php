<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPesakitLuar */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pesakit_luar;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pesakit_luar, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pesakit-luar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

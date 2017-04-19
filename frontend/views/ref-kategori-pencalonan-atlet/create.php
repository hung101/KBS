<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPencalonanAtlet */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pencalonan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pencalonan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pencalonan-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

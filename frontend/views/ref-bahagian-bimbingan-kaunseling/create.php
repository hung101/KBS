<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianBimbinganKaunseling */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bahagian_bimbingan_kaunseling;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bahagian_bimbingan_kaunseling, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-bimbingan-kaunseling-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

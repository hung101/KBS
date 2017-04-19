<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAtletFisiologi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-atlet-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

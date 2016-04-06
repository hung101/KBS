<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanPemakanan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::perkhidmatan_pemakanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_pemakanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-pemakanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanPemakanan */

$this->title = GeneralLabel::createTitle.' '.'Ref Perkhidmatan Pemakanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Perkhidmatan Pemakanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-pemakanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

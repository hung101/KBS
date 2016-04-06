<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBantuanSue */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Bantuan Sue';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Bantuan Sues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bantuan-sue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

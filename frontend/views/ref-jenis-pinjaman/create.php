<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPinjaman */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Pinjaman';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-pinjaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

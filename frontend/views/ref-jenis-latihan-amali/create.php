<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisLatihanAmali */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Latihan Amali';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Latihan Amalis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-latihan-amali-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPejabatYangMendaftarkan */

$this->title = GeneralLabel::createTitle.' '.'Ref Pejabat Yang Mendaftarkan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pejabat Yang Mendaftarkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pejabat-yang-mendaftarkan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKurangUpaya */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Kurang Upaya';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kurang Upayas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kurang-upaya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

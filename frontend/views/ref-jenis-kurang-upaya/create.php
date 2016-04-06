<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKurangUpaya */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kurang_upaya;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kurang_upaya, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kurang-upaya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

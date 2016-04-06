<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPendapatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_pendapatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_pendapatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-pendapatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

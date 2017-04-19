<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisAktiviti */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_aktiviti;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_aktiviti, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-aktiviti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

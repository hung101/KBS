<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPertandinganTemasya */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pertandingan_temasya;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pertandingan_temasya, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pertandingan-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

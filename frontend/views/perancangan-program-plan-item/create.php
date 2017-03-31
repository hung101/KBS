<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAcara */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pelan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-acara-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

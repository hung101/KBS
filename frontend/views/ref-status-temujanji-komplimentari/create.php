<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiKomplimentari */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Temujanji Komplimentari';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Temujanji Komplimentaris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-temujanji-komplimentari-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiKomplimentari */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_temujanji_komplimentari;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_temujanji_komplimentari, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-temujanji-komplimentari-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

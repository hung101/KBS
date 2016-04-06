<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiRehabilitasi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_temujanji_rehabilitasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_temujanji_rehabilitasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-temujanji-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

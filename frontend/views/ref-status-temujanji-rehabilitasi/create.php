<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiRehabilitasi */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Temujanji Rehabilitasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Temujanji Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-temujanji-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

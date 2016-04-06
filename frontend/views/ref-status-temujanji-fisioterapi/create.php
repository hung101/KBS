<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiFisioterapi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_temujanji_fisioterapi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_temujanji_fisioterapi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-temujanji-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

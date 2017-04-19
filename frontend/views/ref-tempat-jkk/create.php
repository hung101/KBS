<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefTempatJkk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tempat." JKK";
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempat." JKK", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tempat-jkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

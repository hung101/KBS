<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefMatawang */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::matawang;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::matawang, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-matawang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

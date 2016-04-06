<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanSatelit */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::perkhidmatan_satelit;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_satelit, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-satelit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

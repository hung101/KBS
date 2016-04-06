<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanSatelit */

$this->title = GeneralLabel::createTitle.' '.'Ref Perkhidmatan Satelit';
$this->params['breadcrumbs'][] = ['label' => 'Ref Perkhidmatan Satelits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-satelit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

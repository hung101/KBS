<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tahap;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tahap, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-program-binaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

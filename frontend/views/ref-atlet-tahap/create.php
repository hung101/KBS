<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAtletTahap */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::atlet_tahap;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_tahap, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-atlet-tahap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

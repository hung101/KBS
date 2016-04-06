<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSijilSpkk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sijil_spkk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sijil_spkk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sijil-spkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

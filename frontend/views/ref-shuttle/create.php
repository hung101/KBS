<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefShuttle */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::maklumat_pemandu;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_pemandu, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-shuttle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

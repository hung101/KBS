<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefBeratBadan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::berat_badans;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::berat_badans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-berat-badan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

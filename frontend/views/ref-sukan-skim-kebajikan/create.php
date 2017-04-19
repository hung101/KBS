<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefSukanSkimKebajikan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-skim-kebajikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

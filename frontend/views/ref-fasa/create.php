<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefFasa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::fasa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::fasa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-fasa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

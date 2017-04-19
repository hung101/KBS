<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefSource */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::source;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::source, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

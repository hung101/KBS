<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefBilJkk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bil;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bil, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bil-jkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

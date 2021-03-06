<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPerwakilan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::perwakilan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perwakilan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perwakilan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefSilibus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::silibus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::silibus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-silibus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

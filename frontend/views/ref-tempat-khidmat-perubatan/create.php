<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefTempatKhidmatPerubatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tempat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tempat-khidmat-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

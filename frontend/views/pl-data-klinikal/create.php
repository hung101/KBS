<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlDataKlinikal */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::data_klinikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::data_klinikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-data-klinikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Satelit */

$this->title = GeneralLabel::createTitle . ' Satelit';
$this->params['breadcrumbs'][] = ['label' => 'Satelit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satelit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

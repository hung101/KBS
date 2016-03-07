<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJkkJkp */

$this->title = GeneralLabel::createTitle . ' Pengurusan JKK/JKP';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan JKK/JKP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

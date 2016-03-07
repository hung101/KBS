<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSajianMakan */

$this->title = GeneralLabel::createTitle . ' Pengurusan Sajian Makan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Sajian Makan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-sajian-makan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

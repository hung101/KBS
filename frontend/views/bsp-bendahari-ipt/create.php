<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::bendahari_ipt;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bendahari_ipt, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-bendahari-ipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

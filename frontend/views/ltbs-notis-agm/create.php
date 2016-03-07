<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsNotisAgm */

//$this->title = 'Tambah Notis Mesyuarat Agong';
$this->title = 'Notis Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => 'Notis Mesyuarat Agong', 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="ltbs-notis-agm-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

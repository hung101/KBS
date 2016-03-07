<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanSediaAda */

$this->title = GeneralLabel::createTitle . ' Pengurusan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kemudahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-sedia-ada-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

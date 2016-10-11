<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanSediaAda */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-sedia-ada-msn-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

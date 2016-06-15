<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_penyelia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penyelia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-e-bantuan-pengurusan_penyelia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

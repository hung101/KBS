<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBidangKonsultansi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bidang_konsultansi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bidang_konsultansi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bidang-konsultansi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

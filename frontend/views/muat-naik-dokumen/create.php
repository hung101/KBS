<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MuatNaikDokumen */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::maklumat_sukan_malaysia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_sukan_malaysia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muat-naik-dokumen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

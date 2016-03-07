<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MuatNaikDokumen */

$this->title = GeneralLabel::createTitle . ' Muat Naik Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Muat Naik Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muat-naik-dokumen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

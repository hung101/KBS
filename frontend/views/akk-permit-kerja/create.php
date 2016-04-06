<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AkkPermitKerja */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::akk_permit_kerja;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akk_permit_kerja, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-permit-kerja-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiSemak */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebantuan_senarai_semak.': ' . ' ' . $model->senarai_semak_id;
$this->title = GeneralLabel::updateTitle . ' Senarai Semak';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_semak, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Senarai Semak', 'url' => ['view', 'id' => $model->senarai_semak_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-semak-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

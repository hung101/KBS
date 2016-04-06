<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanObjektifPertubuhan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebantuan_objektif_pertubuhan.': ' . ' ' . $model->objektif_pertubuhan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_objektif_pertubuhans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->objektif_pertubuhan_id, 'url' => ['view', 'id' => $model->objektif_pertubuhan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-objektif-pertubuhan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

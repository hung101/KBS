<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanObjektifPertubuhan */

$this->title = GeneralLabel::tambah_objektif_pertubuhan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::objektif_pertubuhan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-objektif-pertubuhan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

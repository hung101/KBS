<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KelayakanSukanSpesifikAkk */

$this->title = GeneralLabel::tambah_kelayakan_sukan_spesifik_akk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan_sukan_spesifik_akk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelayakan-sukan-spesifik-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratJkkKehadiran */

$this->title = GeneralLabel::nama_pegawai_coach;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_nama_ahli, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-jkk-kehadiran-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

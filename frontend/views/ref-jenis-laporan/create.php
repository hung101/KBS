<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisLaporan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_laporan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_laporan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-laporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPermohonanPendidikan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_permohonan_pendidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_permohonan_pendidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-permohonan-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

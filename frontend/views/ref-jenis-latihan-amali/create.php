<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisLatihanAmali */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_latihan_amali;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_latihan_amali, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-latihan-amali-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

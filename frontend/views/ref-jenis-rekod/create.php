<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisRekod */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_rekod;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_rekod, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-rekod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

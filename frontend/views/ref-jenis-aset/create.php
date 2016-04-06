<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisAset */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_aset;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_aset, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-aset-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

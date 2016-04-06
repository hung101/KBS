<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKewangan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kewangan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kewangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kewangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

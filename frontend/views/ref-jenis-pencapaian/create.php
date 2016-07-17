<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPencapaian */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_pencapaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_pencapaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-pencapaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

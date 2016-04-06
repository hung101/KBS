<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBajetSumbangan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_bajet_sumbangan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_bajet_sumbangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bajet-sumbangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

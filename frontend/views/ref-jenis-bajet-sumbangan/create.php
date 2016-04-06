<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBajetSumbangan */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Bajet Sumbangan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Bajet Sumbangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bajet-sumbangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

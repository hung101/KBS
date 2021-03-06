<?php

use yii\helpers\Html;


use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianAnugerah */

$this->title = GeneralLabel::createTitle . ' '.GeneralLabel::anugerah;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-anugerah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanSoalSelidik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::soalan_soal_selidik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soalan_soal_selidik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-soalan-soal-selidik-hpt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

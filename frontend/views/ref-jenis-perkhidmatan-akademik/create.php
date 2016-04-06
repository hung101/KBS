<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPerkhidmatanAkademik */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Perkhidmatan Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Perkhidmatan Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-perkhidmatan-akademik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

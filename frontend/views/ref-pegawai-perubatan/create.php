<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPerubatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pegawai_perubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pegawai_perubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

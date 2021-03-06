<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPerubatanFisioterapi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pegawai_perubatan_fisioterapi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pegawai_perubatan_fisioterapi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-perubatan-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

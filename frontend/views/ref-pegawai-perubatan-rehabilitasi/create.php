<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPerubatanRehabilitasi */

$this->title = GeneralLabel::createTitle.' '.'Ref Pegawai Perubatan Rehabilitasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Perubatan Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-perubatan-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

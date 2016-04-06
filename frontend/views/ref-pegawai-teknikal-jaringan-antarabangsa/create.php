<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiTeknikalJaringanAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.'Ref Pegawai Teknikal Jaringan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Teknikal Jaringan Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-teknikal-jaringan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapAkademikPegawaiTeknikal */

$this->title = 'Create Ref Tahap Akademik Pegawai Teknikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Akademik Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-akademik-pegawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspDokumenSokongan */

$this->title = 'Tambah Dokumen Sokongan Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Sokongan Biasiswa Sukan Persekutuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-dokumen-sokongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

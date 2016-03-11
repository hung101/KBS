<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKecederaanMasalahKesihatan */

$this->title = 'Create Ref Jenis Kecederaan Masalah Kesihatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kecederaan Masalah Kesihatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kecederaan-masalah-kesihatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

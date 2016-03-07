<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PemohonKursusTahapAkk */

$this->title = 'Tambah Sains Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Sains Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemohon-kursus-tahap-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

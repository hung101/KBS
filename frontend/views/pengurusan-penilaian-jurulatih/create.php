<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianJurulatih */

$this->title = 'Tambah Pengurusan Penilaian Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Penilaian Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanPenilaianPendidikanPenganjur */

$this->title = GeneralLabel::tambah_pengurusan_soalan_penilaian_pendidikan_penganjurinstructor;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_soalan_penilaian_pendidikan_penganjurinstructor, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-soalan-penilaian-pendidikan-penganjur-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

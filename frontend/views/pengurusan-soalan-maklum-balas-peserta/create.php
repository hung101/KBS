<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanMaklumBalasPeserta */

$this->title = GeneralLabel::tambah_penilaian_prestasi_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_prestasi_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-soalan-maklum-balas-peserta-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

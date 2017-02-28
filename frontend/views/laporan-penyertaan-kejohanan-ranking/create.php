<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LaporanPenyertaanKejohananPegawai */

$this->title = GeneralLabel::tambah.' '.GeneralLabel::kedudukan_ranking;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kedudukan_ranking, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-teknikal-create">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

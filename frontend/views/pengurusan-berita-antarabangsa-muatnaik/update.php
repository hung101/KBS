<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBeritaAntarabangsaMuatnaik */

$this->title = 'Update Pengurusan Berita Antarabangsa Muatnaik: ' . $model->pengurusan_berita_antarabangsa_muatnaik_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Berita Antarabangsa Muatnaiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_berita_antarabangsa_muatnaik_id, 'url' => ['view', 'id' => $model->pengurusan_berita_antarabangsa_muatnaik_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-berita-antarabangsa-muatnaik-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

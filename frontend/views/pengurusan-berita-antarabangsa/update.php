<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBeritaAntarabangsa */

//$this->title = 'Update Pengurusan Berita Antarabangsa: ' . ' ' . $model->pengurusan_berita_antarabangsa_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Berita Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Berita Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Berita Antarabangsa', 'url' => ['view', 'id' => $model->pengurusan_berita_antarabangsa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-berita-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

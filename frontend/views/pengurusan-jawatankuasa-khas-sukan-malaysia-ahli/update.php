<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJawatankuasaKhasSukanMalaysiaAhli */

$this->title = 'Update Pengurusan Jawatankuasa Khas Sukan Malaysia Ahli: ' . ' ' . $model->pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Jawatankuasa Khas Sukan Malaysia Ahlis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id, 'url' => ['view', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-ahli-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

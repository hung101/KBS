<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKaunseling */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::borang_aduan_kaunseling.': ' . ' ' . $model->borang_aduan_kaunseling_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::borang_aduan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_aduan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::borang_aduan_atlet, 'url' => ['view', 'id' => $model->borang_aduan_kaunseling_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kaunseling-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

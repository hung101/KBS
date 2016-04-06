<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenyertaanAtlet */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::borang_penyertaan_atlet.': ' . ' ' . $model->borang_penyertaan_atlet_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::borang_penyertaan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_penyertaan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::borang_penyertaan_atlet, 'url' => ['view', 'id' => $model->borang_penyertaan_atlet_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penyertaan-atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenyertaanAtlet */

//$this->title = 'Update Borang Penyertaan Atlet: ' . ' ' . $model->borang_penyertaan_atlet_id;
$this->title = GeneralLabel::updateTitle . ' Borang Penyertaan Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Borang Penyertaan Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Borang Penyertaan Atlet', 'url' => ['view', 'id' => $model->borang_penyertaan_atlet_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penyertaan-atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

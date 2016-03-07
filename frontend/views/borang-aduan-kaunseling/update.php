<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKaunseling */

//$this->title = 'Update Borang Aduan Kaunseling: ' . ' ' . $model->borang_aduan_kaunseling_id;
$this->title = GeneralLabel::updateTitle . ' Borang Aduan Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Borang Aduan Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Borang Aduan Atlet', 'url' => ['view', 'id' => $model->borang_aduan_kaunseling_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kaunseling-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

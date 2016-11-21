<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukan */

//$this->title = 'Update Khidmat Perubatan Dan Sains Sukan: ' . $model->khidmat_perubatan_dan_sains_sukan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::khidmat_perubatan_dan_sains_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::khidmat_perubatan_dan_sains_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::khidmat_perubatan_dan_sains_sukan, 'url' => ['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelAtlet' => $searchModelAtlet,
        'dataProviderAtlet' => $dataProviderAtlet,
        'searchModelJurulatih' => $searchModelJurulatih,
        'dataProviderJurulatih' => $dataProviderJurulatih,
        'searchModelPegawai' => $searchModelPegawai,
        'dataProviderPegawai' => $dataProviderPegawai,
        'readonly' => $readonly,
    ]) ?>

</div>

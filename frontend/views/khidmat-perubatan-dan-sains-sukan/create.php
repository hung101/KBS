<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::khidmat_perubatan_dan_sains_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::khidmat_perubatan_dan_sains_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-create">

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

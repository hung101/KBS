<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjamin */

//$this->title = 'Update Bsp Kedudukan Kewangan Penjamin: ' . ' ' . $model->bsp_kedudukan_kewangan_penjamin_id;
$this->title = GeneralLabel::updateTitle . ' Kedudukan Kewangan Penjamin';
//$this->params['breadcrumbs'][] = ['label' => 'Kedudukan Kewangan Penjamin', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Kedudukan Kewangan Penjamin', 'url' => ['view', 'id' => $model->bsp_kedudukan_kewangan_penjamin_id]];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspKedudukanKewanganPenjaminJenisHarta' => $searchModelBspKedudukanKewanganPenjaminJenisHarta,
        'dataProviderBspKedudukanKewanganPenjaminJenisHarta' => $dataProviderBspKedudukanKewanganPenjaminJenisHarta,
        'readonly' => $readonly,
    ]) ?>

</div>

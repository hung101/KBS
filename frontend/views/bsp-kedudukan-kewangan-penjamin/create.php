<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjamin */

$this->title = GeneralLabel::createTitle . ' Kedudukan Kewangan Penjamin';
//$this->params['breadcrumbs'][] = ['label' => 'Kedudukan Kewangan Penjamin', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspKedudukanKewanganPenjaminJenisHarta' => $searchModelBspKedudukanKewanganPenjaminJenisHarta,
        'dataProviderBspKedudukanKewanganPenjaminJenisHarta' => $dataProviderBspKedudukanKewanganPenjaminJenisHarta,
        'readonly' => $readonly,
    ]) ?>

</div>

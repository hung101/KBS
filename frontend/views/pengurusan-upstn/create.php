<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanUpstn */

$this->title = GeneralLabel::createTitle .' '. GeneralLabel::laporan_pemantauan_usptn;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::laporan_pemantauan_usptn, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-upstn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanUpstnAtlet' => $searchModelPengurusanUpstnAtlet,
        'dataProviderPengurusanUpstnAtlet' => $dataProviderPengurusanUpstnAtlet,
        'searchModelPengurusanUpstnJurulatih' => $searchModelPengurusanUpstnJurulatih,
        'dataProviderPengurusanUpstnJurulatih' => $dataProviderPengurusanUpstnJurulatih,
        'readonly' => $readonly,
    ]) ?>

</div>

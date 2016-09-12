<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBeritaAntarabangsa */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::maklumat_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-berita-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanBeritaAntarabangsaMuatnaik' => $searchModelPengurusanBeritaAntarabangsaMuatnaik,
        'dataProviderPengurusanBeritaAntarabangsaMuatnaik' => $dataProviderPengurusanBeritaAntarabangsaMuatnaik,
        'readonly' => $readonly,
    ]) ?>

</div>

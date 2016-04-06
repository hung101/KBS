<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\GajiDanElaunJurulatih */

$this->title = GeneralLabel::createTitle . ' Gaji Dan Elaun Jurulatih';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::gaji_dan_elaun_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-dan-elaun-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelElaunJurulatih' => $searchModelElaunJurulatih,
        'dataProviderElaunJurulatih' => $dataProviderElaunJurulatih,
        'readonly' => $readonly,
    ]) ?>

</div>

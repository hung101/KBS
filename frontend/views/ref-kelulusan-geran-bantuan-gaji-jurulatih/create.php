<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanGeranBantuanGajiJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan_geran_bantuan_gaji_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_geran_bantuan_gaji_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-geran-bantuan-gaji-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

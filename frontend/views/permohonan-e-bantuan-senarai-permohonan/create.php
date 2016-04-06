<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiPermohonan */

$this->title = GeneralLabel::tambah_senarai_permohonan_yang_telah_diluluskan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_permohonan_yang_telah_diluluskan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-permohonan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

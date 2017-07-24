<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanElaun */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bantuan_elaun.': ' . ' ' . $model->bantuan_elaun_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::bantuan_elaun_sueelaun_penyelarasemolumen_psk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_elaun_sueelaun_penyelarasemolumen_psk, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::bantuan_elaun_sueelaun_penyelarasemolumen_psk, 'url' => ['view', 'id' => $model->bantuan_elaun_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-elaun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBantuanElaunMuatnaik' => $searchModelBantuanElaunMuatnaik,
        'dataProviderBantuanElaunMuatnaik' => $dataProviderBantuanElaunMuatnaik,
        'readonly' => $readonly,
    ]) ?>

</div>

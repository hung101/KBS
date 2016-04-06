<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiAktivitiProjek */

$this->title = GeneralLabel::tambah_senarai_aktiviti_projek_yang_dijalankan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_aktiviti_projek_yang_dijalankan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-aktiviti-projek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

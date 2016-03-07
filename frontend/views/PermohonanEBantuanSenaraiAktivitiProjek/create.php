<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiAktivitiProjek */

$this->title = 'Tambah Senarai Aktiviti / Projek Yang Dijalankan';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Aktiviti / Projek Yang Dijalankan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-aktiviti-projek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

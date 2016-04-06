<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanDokumenSokongan */

$this->title = GeneralLabel::tambah_elaporan_dokumen_sokongan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_dokumen_sokongan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-dokumen-sokongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

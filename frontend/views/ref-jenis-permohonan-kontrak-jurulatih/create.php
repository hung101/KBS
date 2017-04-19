<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPermohonanKontrakJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_permohonan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_permohonan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-permohonan-kontrak-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

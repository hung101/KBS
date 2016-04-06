<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisSijilKelayakanJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_sijil_kelayakan_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_sijil_kelayakan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-sijil-kelayakan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

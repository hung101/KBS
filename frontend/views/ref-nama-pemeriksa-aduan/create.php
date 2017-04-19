<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefNamaPemeriksaAduan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::nama_pemeriksa_aduan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::nama_pemeriksa_aduan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-pemeriksa-aduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

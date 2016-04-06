<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanPesertaPerhimpunanKem */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jawatan_peserta_perhimpunan_kem;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jawatan_peserta_perhimpunan_kem, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-peserta-perhimpunan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

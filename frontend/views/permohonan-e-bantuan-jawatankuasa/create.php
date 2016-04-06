<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanJawatankuasa */

$this->title = GeneralLabel::tambah_jawatankuasa_kerja_yang_terkini;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jawatankuasa_kerja_yang_terkini, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-jawatankuasa-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanJawatankuasa */

$this->title = 'Tambah Jawatankuasa Kerja Yang Terkini';
$this->params['breadcrumbs'][] = ['label' => 'Jawatankuasa Kerja Yang Terkini', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-jawatankuasa-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

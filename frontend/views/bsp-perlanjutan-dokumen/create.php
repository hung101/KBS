<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanDokumen */

$this->title = GeneralLabel::tambah_dokumen_pelanjutan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::dokumen_pelanjutan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-dokumen-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPerbelanjaan */

$this->title = GeneralLabel::tambah.' '.GeneralLabel::perbelanjaan_penyertaan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perbelanjaan_penyertaan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-perbelanjaan-create">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

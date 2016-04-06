<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanObjektif */

$this->title = GeneralLabel::tambah_objektif_pelaksanaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::objektif_pelaksanaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-objektif-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiPermohonan */

$this->title = 'Tambah Senarai Permohonan Yang Telah Diluluskan';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Permohonan Yang Telah Diluluskan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-permohonan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

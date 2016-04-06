<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiSukan */

$this->title = GeneralLabel::tambah_prestasi_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::prestasi_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

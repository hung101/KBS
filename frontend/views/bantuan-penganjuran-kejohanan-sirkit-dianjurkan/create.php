<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkitDianjurkan */

$this->title = 'Create Bantuan Penganjuran Kejohanan Dianjurkan';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Dianjurkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-dianjurkan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

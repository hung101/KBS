<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkitBayaran Atlet::findOne($id)*/

$this->title = 'Create Bantuan Penganjuran Kejohanan Bayaran';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Bayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-bayaran-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

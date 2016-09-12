<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentifJurulatih */

$this->title = 'Create Pembayaran Insentif Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Insentif Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

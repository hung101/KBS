<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPembayaranKepada */

$this->title = 'Create Ref Pembayaran Kepada';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pembayaran Kepadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pembayaran-kepada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

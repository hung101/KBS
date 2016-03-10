<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBidangKonsultansi */

$this->title = 'Create Ref Bidang Konsultansi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bidang Konsultansis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bidang-konsultansi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

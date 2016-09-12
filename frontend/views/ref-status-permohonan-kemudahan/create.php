<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanKemudahan */

$this->title = 'Create Ref Status Permohonan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

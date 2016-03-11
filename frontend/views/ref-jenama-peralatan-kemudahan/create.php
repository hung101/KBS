<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenamaPeralatanKemudahan */

$this->title = 'Create Ref Jenama Peralatan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenama Peralatan Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenama-peralatan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

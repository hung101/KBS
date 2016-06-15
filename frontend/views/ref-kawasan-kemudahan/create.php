<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKawasanKemudahan */

$this->title = 'Create Ref Kawasan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kawasan Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kawasan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

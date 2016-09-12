<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefCawanganKemudahan */

$this->title = 'Create Ref Cawangan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Cawangan Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-cawangan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianKemudahan */

$this->title = 'Create Ref Bahagian Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTawaranAtlet */

$this->title = 'Create Ref Tawaran Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tawaran Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tawaran-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

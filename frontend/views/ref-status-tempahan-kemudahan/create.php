<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTempahanKemudahan */

$this->title = 'Create Ref Status Tempahan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Tempahan Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-tempahan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

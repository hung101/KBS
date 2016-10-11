<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiKemudahan */

$this->title = GeneralLabel::createTitle.' Agensi Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Agensi Kemudahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

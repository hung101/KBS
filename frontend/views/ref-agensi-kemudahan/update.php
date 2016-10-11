<?php
use app\models\general\GeneralLabel;

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiKemudahan */

$this->title = GeneralLabel::updateTitle.' Agensi Kemudahan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Agensi Kemudahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-kemudahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

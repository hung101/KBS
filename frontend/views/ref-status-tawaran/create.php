<?php
use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTawaran */

$this->title = GeneralLabel::createTitle.' Status Tawaran';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_tawaran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-tawaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

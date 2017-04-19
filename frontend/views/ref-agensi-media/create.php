<?php
use app\models\general\GeneralLabel;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiMedia */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::agensi_media;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::agensi_media, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

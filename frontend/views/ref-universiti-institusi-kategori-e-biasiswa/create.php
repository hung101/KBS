<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefUniversitiInstitusiKategoriEBiasiswa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::universiti;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::universiti, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-universiti-institusi-kategori-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

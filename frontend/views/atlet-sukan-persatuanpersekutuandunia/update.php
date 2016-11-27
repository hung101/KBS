<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSukanPersatuanpersekutuandunia */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_sukan_persatuanpersekutuandunia.': ' . ' ' . $model->persatuan_persekutuan_dunia_id;
$this->title = GeneralLabel::updateTitle . ' '. GeneralLabel::persatuanpersekutuan_dunia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::persatuanpersekutuan_dunia, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '. GeneralLabel::persatuanpersekutuan_dunia, 'url' => ['view', 'id' => $model->persatuan_persekutuan_dunia_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-sukan-persatuanpersekutuandunia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

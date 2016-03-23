<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilWartawanSukan */

//$this->title = 'Update Profil Wartawan Sukan: ' . ' ' . $model->profil_wartawan_sukan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::profil_wartawan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_wartawan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_wartawan_sukan, 'url' => ['view', 'id' => $model->profil_wartawan_sukan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-wartawan-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>

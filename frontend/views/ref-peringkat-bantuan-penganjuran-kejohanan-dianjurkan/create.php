<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanPenganjuranKejohananDianjurkan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peringkat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peringkat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-bantuan-penganjuran-kejohanan-dianjurkan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

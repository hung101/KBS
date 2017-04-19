<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanPenganjuranKejohanan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peringkat_bantuan_penganjuran_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peringkat_bantuan_penganjuran_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

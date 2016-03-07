<?php
use yii\helpers\Html;
use yii\helpers\Url;

// table reference
use app\models\AdminEBiasiswa;

use common\models\general\GeneralFunction;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'e-Biasiswa';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="list-group">
    <?php 
        $results = AdminEBiasiswa::find()->where(['=', 'aktif', 1])->andwhere(['>=', 'tarikh_tamat', date(GeneralVariable::saveDateFormat)])->andwhere(['<=', 'tarikh_mula', date(GeneralVariable::saveDateFormat)])->orderBy('tarikh_tamat')->all();
        
        foreach ($results as $modelAdminEBiasiswa) { 
            echo '<a href="'.Url::to(['/permohonan-e-biasiswa/load', 'admin_e_biasiswa_id' => $modelAdminEBiasiswa->admin_e_biasiswa_id]).'" class="list-group-item">';
            echo '<h4 class="list-group-item-heading">'.$modelAdminEBiasiswa->nama.'</h4>';
            echo '<p class="list-group-item-text">Tarikh permohonan dibuka '.GeneralFunction::convert($modelAdminEBiasiswa->tarikh_mula).' hingga '.GeneralFunction::convert($modelAdminEBiasiswa->tarikh_tamat).'</p>';
            echo '<!--<p class="list-group-item-text">'.Html::a('Muat Turun Syarat Kelayakan', 'javascript:void(0);', ['onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl . '/' . $modelAdminEBiasiswa->muat_naik_syarat_kelayakan . '");']).'</p>-->';
            echo '</a>';
        }
    ?>
        
        <a href="<?=Url::to(['permohonan-e-biasiswa/index'])?>" class="list-group-item">
          <h4 class="list-group-item-heading">Sejarah Permohonan</h4>
          <p class="list-group-item-text">Senarai Permohonan</p>
        </a>
    </div>

</div>

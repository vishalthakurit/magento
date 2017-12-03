<?php

class Excellence_Caroussel_Block_Caroussel extends Mage_Core_Block_Template {

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getCarousselImages($brand) {
        $caroussel = Mage::getModel('caroussel/caroussel')->load($brand, 'brand_name');
        $carousselImages = $caroussel->getImageName();
        return $carousselImages;
    }

    public function getCarousselImagesLabels($brand) {
        $caroussel = Mage::getModel('caroussel/caroussel')->load($brand, 'brand_name');
        $carousselLabels = $caroussel->getImageUrl();
        return $carousselLabels;
    }

    public function getImageNewTab($brand) {
        $caroussel = Mage::getModel('caroussel/caroussel')->load($brand, 'brand_name');
        $imageNewTab = $caroussel->getNewTab();
        return $imageNewTab;
    }

    public function getImageLabel($brand) {
        $caroussel = Mage::getModel('caroussel/caroussel')->load($brand, 'brand_name');
        $ImageLabel = $caroussel->getImageLabel();
        return $ImageLabel;
    }

    public function getImageLabelPath($imageLabel) {
        $ImageLabelPath = '';
        switch ($imageLabel) {
            case "Hotel":
                 $ImageLabelPath = 'label-hoteis.png';
                break;
            case "Pacote":
                 $ImageLabelPath = 'label-pacotes.png';
                break;
            case "Já":
                 $ImageLabelPath = 'label-zarpo-ja.png';
                break; 
            case "Vale":
                 $ImageLabelPath = 'label-presentes.png';
                break; 
            case "None":
                 $ImageLabelPath = '';
                break;
        }
        return $ImageLabelPath;
    }
    
    public function getTagBannerImagePath(){
      $image='';
     if(Mage::app()->getWebsite()->getCode() == 'last_minute'){
       $image= 'label-zarpo-ja.png';  
     }else if(Mage::app()->getWebsite()->getCode() == 'zarpo'){
          $image= 'label-hoteis.png';  
        if(isset($_REQUEST['pagepacote'])){
              $image = 'label-pacotes.png';
        }else if(isset($_REQUEST['vale-presente'])){
             $image = 'label-presentes.png';
        } 
     }
     
     return $image;
    }

}

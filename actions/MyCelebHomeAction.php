<?php
class MyCelebHomeAction extends BaseAction
{
  public function init() {
    parent::init();
    $this->addScript("jquery8.js");
    $this -> template = "MyCelebHome.tpl";
    $this->addScript("bootstrap.js");
	//$this->addPostAction("Profession");
    $this->addPostAction("SearchCeleb");
	//$this->addPostAction("CelebContent");
    
  }
  public function execute($request, $response)
  {
    
  }
  
}
?>
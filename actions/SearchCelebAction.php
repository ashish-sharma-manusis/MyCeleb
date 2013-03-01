<?php
class SearchCelebAction extends Action
{
  public function init() {
    parent::init();
    $this->addScript("jquery8.js");
    $this -> template = "SearchCeleb.tpl";
    $this->addScript("bootstrap.js");
    
  }
  public function execute($request, $response)
  {
    
  }
  
}
?>
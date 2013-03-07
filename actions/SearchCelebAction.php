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
    $request -> name = !empty($request -> name) ? $request -> name : "none";
	if($request->name != "none")
	{
		$id = MongoUtility::getMongoIdByName($request->name);
		Logger::info("???????????????????",$id);
		//header('Location: CelebDetail?id='.$id);
		//header("Location: http://www.w3schools.com/");
	}
  }
  
}
?>
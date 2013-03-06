<?php
class MyCelebHomeAction extends BaseAction
{
  public function init() {
    parent::init();
    $this->addScript("jquery8.js");
    $this -> template = "MyCelebHome.tpl";
    $this->addScript("bootstrap.js");
	$this->addPostAction("Profession");
    $this->addPostAction("SearchCeleb");
	$this->addPostAction("CelebContent");
	$this->addScript("celeb.js");
    
  }
  public function execute($request, $response)
  { //for populating people table...............
    $query = array(array(
    				"type"=>"/celebrities/celebrity",
    				 "/type/object/type"=>array(),
                     "*"=>NULL,
                     //"id"=>NULL,
                     "type"=>"/people/person",
                     "limit"=>200
                     ));
	//$res = FreebaseUtility::getFullResult($query, true);
	//MyCelebHomeAction::insertCelebrities($res);
	//Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>>",$res);
  }
  
  Public function insertCelebrities($res)
  {
  	
	foreach ($res as $key => $value) {
		$r["_id" ] = $value->id;
		foreach ($value as $k => $v) {
			if($k == "/type/object/type")
			{
			$r["types"] = $v;
			}
			else if($k == "key")
			{
				
			}
			else {
				$r[$k] = $v;
			}
		}
		Logger::info(">>>>>>>>>>>>>>>>>>>>>>R",$r);
		MongoUtility::mongoDBWrite($r,"people_person");
		}
  }
}
?>
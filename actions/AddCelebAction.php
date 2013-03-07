<?php
class AddCelebAction extends BaseAction
{
  public function init() {
    parent::init();
    $this->addScript("jquery8.js");
    $this -> template = "AddCeleb.tpl";
    $this->addScript("bootstrap.js");
	$this->addScript("celeb.js");
    
  }
  public function execute($request, $response)
  { 
    $query = array(array(
    				//"type"=>"/celebrities/celebrity",
    				 "/type/object/type"=>array(),
                     "*"=>NULL,
                     "id"=>$request->id,
                     "type"=>"/people/person",
                     ));
	$res = FreebaseUtility::getQueryResults($query, true);
	//Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>>",$res);
	$res = AddCelebAction::insertCelebrities($res);
	
	$response->info = $res;
  }
  
  Public function insertCelebrities($res1)
  {
  	$res = $res1->result[0];
	$res = array($res);
	foreach ($res as $key => $value) {
		foreach ($value as $k => $v) {
			Logger::info(">>>>>>>>>>>>>>>>>>>>>>k",$k);
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
	}
	$r["_id"] = $r["id"];
		Logger::info(">>>>>>>>>>>>>>>>>>>>>>R",$r);
		MongoUtility::mongoDBWrite($r,"people_person");
		return $r;
		
  }
}
?>
<?php
class CelebDetailAction extends BaseAction
{
  public function init() {
    parent::init();
    $this->addScript("jquery8.js");
    $this -> template = "CelebDetail.tpl";
    $this->addScript("bootstrap.js");
    
  }
  public function execute($request, $response)
  {
  	 $types = CelebDetailAction::getTypes($request->id);
	 $res = CelebDetailAction::getAllData($request->id, $types);
	 $response->info = $res;
  }
  public function getTypes($id)
  {
  	$data = MongoUtility::getMongoDataByID($id,"people_person");
	$data = $data[0]["types"];
	Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>",$data);
	return $data;
  }
  public function getAllData($id,$types)
  {
  	$data=array();
	$temp = MongoUtility::getMongoDataByID($id,"people_person");
	$data["Basic"] = $temp[0];
	$temp = MongoUtility::getMongoDataByID($id,"common_topic");
	$data["Common"] = $temp[0];
  	foreach ($types as $key => $value) {  		
		  if($value == "/film/actor")
		  {
		  	$data["Film"]= PopulateType::getFilmActor($id);
		  }
		  if($value == "/music/artist")
		  {
		  	$data["Music"]= PopulateType::getMusicArtist($id);
		  }
		  if($value == "/award/award_winner")
		  {
		  	$data["Award"]= PopulateType::getAward_winner($id);
		  }
	  }
	Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>DATA",$data);
	return $data;
  }
  /*
  public function getAllData($id, $types)
    {
        //Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>",$types);
        $data = array();
        foreach ($types as $key => $type) {
            if($type == "/common/topic")
          {
              $data[$key] = MongoUtility::getCommonInfo($id,$type);
          }
          else {
              $data[$key] = MongoUtility::getInfo($id,$type);
              //Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>",$data[$key]);
          }	  
        }
      Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>",$data);
      return $data;
              }*/
  
}
?>
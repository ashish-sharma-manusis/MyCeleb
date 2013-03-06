<?php
class MongoUtility
{
	
  public function getMongoDataByID($id,$type)
	{
		$m = new MongoClient();
    $db = $m->db;
    $collection = $db->$type;
	$myarray = array("_id" => $id);
    $ans = $collection->find($myarray);
    $data=array();
       $i=0;
       foreach($ans as $person){
              $data[$i]=$person;
              $i++;
               }
    return $data;
	}
	public function getMongoDataByProfession($profession)
	{
		$m = new MongoClient();
    $db = $m->db;
    $collection = $db->people_person;
	$myarray = array("profession" => $profession);
    $ans = $collection->find($myarray);
    $data=array();
       $i=0;
       foreach($ans as $person){
              $data[$i]=$person;
              $i++;
               }
    return $data;
	}
	public function getMongoDataByCollection($collection,$limit)
	{
		$m = new MongoClient();
    $db = $m->db;
    $collection = $db->$collection;
    $ans = $collection->find()->limit($limit);
    $data=array();
       $i=0;
       foreach($ans as $person){
              $data[$i]=$person;
              $i++;
               }
    //Logger::info("<<<<<<<<<<<<<<<<<<<<<<<<<<<<<",$data);
    return $data;
	}
	public function mongoDBWrite($r,$type)
  {
    
    //Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>WRITE",$r);
    $m = new MongoClient();
	$db = $m->db;
    $collection = $db->$type;
    //$collection->remove();
    $remove_array = array("_id" => $r["_id"]);
    $collection->remove($remove_array);
    $collection->insert($r);
  }
  public function getInfo($id,$type)
	{
		$collection = MongoUtility::getMongoName($type);
		$data = MongoUtility::getMongoDataByID($id,$collection);
		if($data == NULL)
		{
			$query = array(array(
								"type"=>$type,
								"id"=>$id,
								"*"=>NULL
								));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res->result[0];
			foreach ($res as $key => $value) {
				$r[$key] = $value;
			}
			$r["_id"] = $res->id;
			MongoUtility::mongoDBWrite($r,$collection);
			return $r;
		}
		else {
			return $data[0];
		}
	}
	public function getMongoName($str)
	{
		$str = str_replace("/", "_", $str);
		if($str[0] == "_")
		{
			$str = substr($str, 1);
		}
		//Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>MongoName", $str);
		return $str;
	}
	public function getCommonInfo($id,$type)
	{
		$collection = MongoUtility::getMongoName($type);
		$data = MongoUtility::getMongoDataByID($id,$collection);
		if($data == NULL)
		{
			$query = array(array(
								"type"=>$type,
								"id"=>$id,
								"image"=>array(array("id"=>NULL)),
								"article"=>array(array("id"=>NULL)),
								"description"=>array(),
								"alias"=>array(),
								"official_website"=>array()
								));
			$res = FreebaseUtility::getQueryResults($query);
			Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>RES", $res);
			$res = $res->result[0];
			$img = array();
			$art = array();
			foreach ($res as $key => $value) {						
				if($key == "image")
				{
					foreach ($value as $k => $v) {
						$img[$k] = $v->id;
					}
				}
				elseif ($key == "article") {
					foreach ($value as $k => $v) {
						$art[$k] = MongoUtility::getPersonContent($v->id);
						
					}
				}
				else {
					$r[$key] = $value;
				}
			}
			$r["image"] = $img;
			$r["_id"] = $res->id;
			$r["article"] = $art;
			MongoUtility::mongoDBWrite($r,$collection);
			return $r;
		}
		else {
			return $data[0];
		}
	}
public function getPersonContent($id){
               $url='http://api.freebase.com/api/trans/raw/' . $id;
               $curl = new CurlWrapper($url);
               $response = $curl->get();
               return $response;
       }
}
?>

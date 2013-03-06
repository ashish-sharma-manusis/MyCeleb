<?php
class PopulateType
{ //for type Film/Actor
	public static function getFilmActor($id)
	{
		$res = MongoUtility::getMongoDataByID($id,"film_actor");
		if($res == NULL)
		{
			$query=array(array(
				"id" => $id ,
				"type" => "/film/actor" ,
				"film" => array(array("id"=> null))
				));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res->result[0];
			$i=0;
			foreach($res->film as $film)
			{
				$data=array();
				$data["id"]=$film->id;
				$data["film_name"]= self::getFilmPerformance($film->id)->film;
				$result[]=$data;
				if($i==10)
					break;
				$i++;
			}
			$output["_id"] = $id;
			$output["film"]=$result;
			MongoUtility::mongoDBWrite($output,"film_actor");
		}
		else {
			$output = $res[0];
		}
	//Logger :: info("===============filmactor>>>>>>>>>>>>>",$output);
	return $output;
	}
	public static function getFilmPerformance($id)
	{
	$query=array(array(
  		"id" => $id,
  		"type" => "/film/performance",
  		"character" => null,
  		"film" => null,
  		"actor" => null
  	));
	$res = FreebaseUtility::getQueryResults($query);
	$res = $res->result[0];
	return $res;
	//Logger :: info("===============filmactor>>>>>>>>>>>>>",$res);
	foreach($res as $key=>$value)
	{
		$data[$key]=$value;
	}
	//Logger :: info("===============filmactor>>>>>>>>>>>>>",$data);
  }
  //for music
  public static function getMusicArtist($id)
  {
  	$res = MongoUtility::getMongoDataByID($id,"music_artist");
		if($res == NULL)
		{
		  	$query = array(array(
		  		 "id" => "/en/jennifer_lopez",
		   		"type" => "/music/artist",
		   		"genre" => array(),
		  		"active_start" => null,
		  		"active_end" => null,
		  		"album" => array(),
		  		"track" => array()
			));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res->result[0];
			foreach($res as $key=>$value)
			{
				$data[$key]=$value;
			}
			
			$data["_id"] = $id;
			MongoUtility::mongoDBWrite($data,"music_artist");
		}
		else
			{
				$data = $res[0];
			}
			//Logger :: info("===============getMusicArtist>>>>>>>>>>>>>",$data);
	return $data;
  }
   public function getAward_winner($id)
  {
  	$res = MongoUtility::getMongoDataByID($id,"award_winner");
		if($res == NULL)
		{
		  	$query = array(array(
		  		"id" => $id ,
		  		"type" => "/award/award_winner",
		  		"awards_won" => array(array("id" => null)),
			));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res->result[0];
			foreach($res as $key=>$value)
			{
				foreach($value as $v){
					$data[]=self :: getAward_honor($v->id);
				}
			}
			$data["_id"]=$id;
			MongoUtility::mongoDBWrite($data,"award_winner");
		}
		else
			{
				$data = $res[0];
			}
	Logger :: info("===============getAwardAward>>>>>>>>>>>>>",$data);
	return $data;
  }
  public function getAward_honor($id)
  {
  	$query = array(array(
  		"id" => $id ,
  		"type"=> "/award/award_honor",
  		"year" => null,
  		"award" => null,
  		"award_winner" => array(),
  		"honored_for" => array(),
  		"ceremony" => null
	));
	$res = FreebaseUtility::getQueryResults($query);
	$res = $res->result[0];
	//Logger :: info("===============getAwardAw_honor>>>>>>>>>>>>>",$res);
	foreach($res as $key=>$value)
	{
		$data[$key]=$value;
	}
	return $data;
  }
}
?>
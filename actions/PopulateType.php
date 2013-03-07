<?php
class PopulateType {//for type Film/Actor
	public static function getFilmActor($id) {
		$res = MongoUtility::getMongoDataByID($id, "film_actor");
		if ($res == NULL) {
			$query = array( array("id" => $id, "type" => "/film/actor", "film" => array( array("id" => null))));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res -> result[0];
			$i = 0;
			foreach ($res->film as $film) {
				$data = array();
				$data["id"] = $film -> id;
				$data["film_name"] = self::getFilmPerformance($film -> id) -> film;
				$result[] = $data;
				if ($i == 10)
					break;
				$i++;
			}
			$output["_id"] = $id;
			$output["film"] = $result;
			MongoUtility::mongoDBWrite($output, "film_actor");
		} else {
			$output = $res[0];
		}
		//Logger :: info("===============filmactor>>>>>>>>>>>>>",$output);
		return $output;
	}

	public static function getFilmPerformance($id) {
		$query = array( array("id" => $id, "type" => "/film/performance", "character" => null, "film" => null, "actor" => null));
		$res = FreebaseUtility::getQueryResults($query);
		$res = $res -> result[0];
		return $res;
		//Logger :: info("===============filmactor>>>>>>>>>>>>>",$res);
		foreach ($res as $key => $value) {
			$data[$key] = $value;
		}
		//Logger :: info("===============filmactor>>>>>>>>>>>>>",$data);
	}

	//for music
	public static function getMusicArtist($id) {
		$res = MongoUtility::getMongoDataByID($id, "music_artist");
		if ($res == NULL) {
			$query = array( array("id" => $id, "type" => "/music/artist", "genre" => array(), "active_start" => null, "active_end" => null, "album" => array(), "track" => array()));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res -> result[0];
			foreach ($res as $key => $value) {
				$data[$key] = $value;
			}

			$data["_id"] = $id;
			MongoUtility::mongoDBWrite($data, "music_artist");
		} else {
			$data = $res[0];
		}
		//Logger :: info("===============getMusicArtist>>>>>>>>>>>>>",$data);
		return $data;
	}

	public function getAward_winner($id) {
		$res = MongoUtility::getMongoDataByID($id, "award_winner");
		if ($res == NULL) {
			$query = array( array("id" => $id, "type" => "/award/award_winner", "awards_won" => array( array("id" => null)), ));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res -> result[0];
			foreach ($res as $key => $value) {
				foreach ($value as $v) {
					$data[] = self::getAward_honor($v -> id);
				}
			}
			$data["_id"] = $id;
			MongoUtility::mongoDBWrite($data, "award_winner");
		} else {
			$data = $res[0];
		}
		Logger::info("===============getAwardAward>>>>>>>>>>>>>", $data);
		return $data;
	}

	public function getAward_honor($id) {
		$query = array( array("id" => $id, "type" => "/award/award_honor", "year" => null, "award" => null, "award_winner" => array(), "honored_for" => array(), "ceremony" => null));
		$res = FreebaseUtility::getQueryResults($query);
		$res = $res -> result[0];
		//Logger :: info("===============getAwardAw_honor>>>>>>>>>>>>>",$res);
		foreach ($res as $key => $value) {
			$data[$key] = $value;
		}
		return $data;
	}

	public static function getOlympicsAwards($id) {
		$res = MongoUtility::getMongoDataByID($id, "olympics_award");
		if ($res == NULL) {
			$query = array( array("id" => $id, "type" => "/olympics/olympic_athlete", "medals_won" => array( array("id" => null)), ));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res -> result[0];
			//Logger :: info("==============res>>>>>>>>>>>>>",$res);
			foreach ($res->medals_won as $value) {
				$data[] = self::getOlympicsAwardDetails($value -> id);
			}
			$output[_id] = $id;
			$output[awards] = $data;
			MongoUtility::mongoDBWrite($ouput, "olympics_award");
		} else {
			$ouput = $res[0];
		}
		//Logger :: info("=============output=>>>>>>>>>>>>>",$output);
		return $output;
	}

	public function getOlympicsAwardDetails($id) {
		$query = array( array("id" => $id, "type" => "/olympics/olympic_medal_honor", "country" => null, "event" => null, "medal" => null, "olympics" => null));
		$res = FreebaseUtility::getQueryResults($query);
		$res = $res -> result[0];
		foreach ($res as $key => $value) {
			$data[$key] = $value;
		}
		return $data;
	}

	public static function getCelebritiesDetails($id) {
		$res = MongoUtility::getMongoDataByID($id, "celebrities_detail");
		if ($res == NULL) {
			$query = array( array("id" => $id, "type" => "/celebrities/celebrity", "celebrity_friends" => array( array("id" => null)), "net_worth" => array( array("id" => null)), "sexual_relationships" => array( array("id" => null))));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res -> result[0];
			Logger::info("=============getCelebties=>>>>>>>>>>>>>", $res);
			$output[_id] = $res -> id;
			foreach ($res as $key => $value) {
				if ($key == "celebrity_friends") {
					$data = array();
					foreach ($value as $v) {
						$data[] = self::getCelebrityFriendsName($v -> id);

					}
					$output[$key] = $data;
				}
				if ($key == "net_worth") {
					$data = array();
					foreach ($value as $v) {
						$data[] = self::getNetWorth($v -> id);

					}
					$output[$key] = $data;
				}
				if ($key == "sexual_relationships") {
					$data = array();
					foreach ($value as $v) {
						$data[] = self::getRelationshipDetail($v -> id);

					}
					$output[$key] = $data;
				}
			}
			MongoUtility::mongoDBWrite($ouput, "celebrities_detail");
		} else {
			$ouput = $res[0];
		}
		//Logger :: info("=============getCelebties=>>>>>>>>>>>>>",$output);
		return $output;
	}

	public function getCelebrityFriendsName($id) {
		$query = array( array("id" => $id, "type" => "/celebrities/friendship", "friend" => array()));
		$res = FreebaseUtility::getQueryResults($query);
		$res = $res -> result[0];
		return $res -> friend;
		Logger::info("=============getCelebties=>>>>>>>>>>>>>", $res);
	}

	public function getNetWorth($id) {
		$query = array( array("id" => $id, "type" => "/measurement_unit/dated_money_value", "amount" => null, "source" => null, "valid_date" => null, "currency" => null));
		$res = FreebaseUtility::getQueryResults($query);
		$res = $res -> result[0];
		foreach ($res as $key => $value) {
			$output[$key] = $value;
		}
		//Logger :: info("=============getCelebties=>>>>>>>>>>>>>",$res);
		return $output;
	}

	public function getRelationshipDetail($id) {
		$query = array( array("id" => $id, "type" => "/celebrities/romantic_relationship", "celebrity" => array(), "start_date" => null, "end_date" => null, "relationship_type" => null));
		$res = FreebaseUtility::getQueryResults($query);
		$res = $res -> result[0];
		foreach ($res as $key => $value) {
			$output[$key] = $value;
		}
		//Logger :: info("=============getCelebties=>>>>>>>>>>>>>",$res);
		return $output;
	}

	public static function getPoliticianDetail($id) {
		$res = MongoUtility::getMongoDataByID($id, "government_politician");
		if ($res == NULL) {
			$query = array( array("id" => $id, "type" => "/government/politician", "government_positions_held" => array( array("basic_title" => null, "office_position_or_title" => null, "governmental_body" => null, "jurisdiction_of_office" => null, "from" => null, "to" => null)), ));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res -> result[0];
			//Logger :: info("=============getPoliticianDetail=>>>>>>>>>>>>>",$res);
			$output["_id"] = $id;
			foreach ($res->government_positions_held as $value) {
				$data = array();
				foreach ($value as $k => $v) {
					$data[$k] = $v;

				}
				$output[] = $data;
			}
			MongoUtility::mongoDBWrite($ouput, "government_politician");
		} else {
			$ouput = $res[0];
		}
		//$output["government_positions_held"]=$data;
		//Logger :: info("=============getPoliticianDetail=>>>>out>>>>>>>>>",$output);

		return $output;
	}

	public static function getBookAuthor($id) {
		$res = MongoUtility::getMongoDataByID($id, "book_author");
		if ($res == NULL) {
			$query = array( array("id" => $id, "type" => "/book/author", "works_written" => array(), ));
			$res = FreebaseUtility::getQueryResults($query);
			$res = $res -> result[0];
			foreach($res as $key=>$value)
       		{
               $output[$key] = $value;
       		}
        $output["_id"]=$id;
		//Logger::info("=============getBookAuthor=>>>>>>>>>>>>>", $res);
		MongoUtility::mongoDBWrite($output, "book_author");
		} else {
			$output = $res[0];
		}
		return $output;
	}
	public static function getCricket($id)
 {
 	$res = MongoUtility::getMongoDataByID($id, "cricket_player");
		if ($res == NULL) {
         $query=array(array(
               "id" => $id,
                 "type" =>"/cricket/cricket_player",
                 "all_rounder" => null,
                 "batting_style"=> null,
                 "odi_stats" => array(array("*" => null , "optional" => true)),
                 "test_stats" => array(array("*" => null , "optional" => true)) 
       ));
       $res = FreebaseUtility::getQueryResults($query);
       $res = $res->result[0];
       //Logger :: info("=============getCricket=>>>>>>>>>>>>>",$res);
       foreach($res as $key=>$value)
       {
               if($key=="odi_stats" || $key=="test_stats")
               {
                       $data=array();
                       foreach($value[0] as $k=>$v)
                       {
                               $data[$k]=$v;
                       }
                       $output[$key] = $data;
               }
               else
               {
                       $output[$key] = $value;
               }
       }
       $output["_id"]=$id;
       //Logger :: info("=============getCricket=>output>>>>>>>>>>>>",$output);
       MongoUtility::mongoDBWrite($output, "cricket_player");
		} else {
			$output = $res[0];
		}
       return $output;        
 }
 
}
?>
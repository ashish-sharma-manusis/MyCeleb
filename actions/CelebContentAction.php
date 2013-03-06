<?php
class CelebContentAction extends Action {
	public function init() {
		parent::init();
		$this -> template = "CelebContent.tpl";
		$this -> addStyle("CelebContent.css");
	}

	public function execute($request, $response) {

		$request -> type = !empty($request -> type) ? $request -> type : "all";
		$d = array();
		
		if ($request -> type == "all") {
			$data = MongoUtility::getMongoDataByCollection("people_person","20");
		}
		if ($request -> type == "politician") {
			$data = MongoUtility::getMongoDataByProfession("Politician","20");			
		}
		if ($request -> type == "artist") {
			$data = MongoUtility::getMongoDataByProfession("Artist","20");	
		}
		if ($request -> type == "athlete") {
			$data = MongoUtility::getMongoDataByProfession("Athlete","20");
			$data = array_merge($data, MongoUtility::getMongoDataByProfession("Racecar driver","20"));
			$data = array_merge($data, MongoUtility::getMongoDataByProfession("Basketball player","20"));
			$data = array_merge($data, MongoUtility::getMongoDataByProfession("Wrestler","20"));
		}
		if ($request -> type == "singer") {
			$data = MongoUtility::getMongoDataByProfession("Singer","20");
			$data = array_merge($data, MongoUtility::getMongoDataByProfession("Musician","20"));
		}
		if ($request -> type == "actor") {
			$data = MongoUtility::getMongoDataByProfession("Actor","20");
		}
		foreach ($data as $key => $values) {
				$id = $values["_id"];
				$d[$key] = array_merge($data[$key], MongoUtility::getCommonInfo($id, "/common/topic"));
				/*
				if ($count == 16) {
									break;
								}
								$count++;*/
				
				//Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>DATA", $d[$key]);
			}
		$response -> basicinfo = $d;
	}

}
?>
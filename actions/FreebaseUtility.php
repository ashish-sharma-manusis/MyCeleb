<?php
class FreebaseUtility
{
	public static function getQueryResults($query, $cursor=true, $extended=0) {
    $query_envelope = array('query' => $query);
    if($cursor) $query_envelope['cursor'] = true;
    if($extended) $query_envelope['extended'] = true;
    $service_url = 'http://api.freebase.com/api/service/mqlread';
    $check = urlencode(json_encode($query_envelope));
    $url = $service_url . '?query=' . urlencode(json_encode($query_envelope));
    $curl = new CurlWrapper($url);
    $response = $curl->get();
	//Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>>Query ",json_decode($response) );
    return json_decode($response);
  }
	public function getFullResult($query, $cursor=true,$extended=0)
	{
		$response = FreebaseUtility::getResultByCursor($query,true);
		//Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>Cursor", $response);
		$cursor = $response->cursor;
		$response = $response->result;
		$count = 0;		
		while($cursor) {
			if($count == 30)
			{
				break;
			}
			$count++;
			$response1 =FreebaseUtility::getResultByCursor($query, $cursor);
			$cursor = $response1->cursor;
			$response = array_merge($response, $response1->result);
		}
		return $response;
	}
	public static function getResultByCursor($query, $cursor=true) {
		$query_envelope = array('query' => $query, 'cursor' => $cursor);
		$service_url = 'http://api.freebase.com/api/service/mqlread';
		$url = $service_url . '?query=' . urlencode(json_encode($query_envelope));
		$curl = new CurlWrapper($url);
		$response = $curl->get();
		return json_decode($response);
	}
	public function getFreebaseName($str)
	{
		$str = str_replace("_", "/", $str);
		if($str[0] != "/")
		{
			$str = "/".$str;
		}
		//Logger::info(">>>>>>>>>>>>>>>>>>>>>>>>>>FreebaseName", $str);
		return $str;
	}
}
?>
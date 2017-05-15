<?php
namespace LaneWeChat\Dev;
class MsgWall{
	public function reply($request){
		$content = "收到文本消息：".$content;
		$msg  = $request['content'];
		switch($msg){
			case "微信墙":
				$content= "http://ts.jomon.cc/wx/login?id=".$request['fromusername'];
			break;
		}

		return $content;
	}
}
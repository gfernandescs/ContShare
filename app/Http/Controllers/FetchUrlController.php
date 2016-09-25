<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FetchUrlController extends Controller
{
    public function fetch(Request $request){
    	
    	if($request->ajax()){

    		$image;

			@$str     = file_get_contents($request->link);
	    	if(strlen($str)>0){
		    	$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
		    	preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title);
		    }

		    $dom = new \DOMDocument();
		    @$dom->loadHTML($str);
		    $images = $dom->getElementsByTagName('img');
		    foreach ($images as $image){
			    $l1 = @parse_url($image->getAttribute('src'));	  	  
			    if($l1){
				  $img[]=$image->getAttribute('src');
			    }
		    }

		    $d = new \DOMDocument();
		   	@$d->loadHTML($str);
		    $xp = new \DOMXpath($d);
		    foreach ($xp->query("//meta[@property='og:image']") as $el){
			    $l2=parse_url($el->getAttribute("content"));
			    if(isset($l2['scheme'])){
				  $img2[]=$el->getAttribute("content");
			    }
			}
			
			if(!isset($title) || empty($title)){
				
		       $title[1] = "";
		    }
			
		    if(isset($img2)){

		      $image = $img2[0];

		    }elseif(isset($img)){
				$url  = $img[0];
				$word = 'p';
				$find = $url[0].$url[1].$url[2].$url[3];
				if($find != "http"){
					$image = $request->link.$img[0];
				}else{
					$image = $img[0];
				}
			}else{
				$image = "";
			}
		    $result = array('title' => $title[1], 'img' => $image);
    		return $result;
    	}

    	

    }
}

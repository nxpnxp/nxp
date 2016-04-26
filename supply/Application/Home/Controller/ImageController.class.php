<?php
namespace Home\Controller;
use Think\Controller;
class ImageController extends Controller {
    public function index(){
		$_file = $_POST['img'];
		$arr = explode('base64,',$_file);
		$handle = base64_decode($arr[1]);
		$filename = time().rand(1,100);
        if(preg_match('/(png)/',$arr[0])){
			$filename .='.png';
			}
		if(preg_match('/(jpeg)/',$arr[0])){
			$filename .='.jpg';
		}
		if(preg_match('/(gif)/',$arr[0])){
			$filename .='.gif';
		}
		$filepath = '../attachment/images/supply/'.$filename;
		file_put_contents($filepath,$handle);
		echo $filepath;
    }
	
}
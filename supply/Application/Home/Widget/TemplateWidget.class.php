<?php
namespace Home\Widget;
use Think\Controller;
class TemplateWidget extends Controller{
	
	public function top()
	{
		$this->display("Template:top");
	}
	
	public function left()
	{
		$this->display("Template:left");
	}
}
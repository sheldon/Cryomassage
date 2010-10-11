<?php
class PageController extends ApplicationController{
  public function controller_global(){
    $this->use_layout = "holding";
    $this->use_view = false;
  }
  public function index(){}
  public function _top_nav(){
    $this->sects = new CmsSection;
    $this->sects = $this->sects->roots();
  }
  
}
?>
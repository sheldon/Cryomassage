<?php
class PageController extends ApplicationController{
  public function index(){}
  public function _top_nav(){
    $this->sects = new CmsSection;
    $this->sects = $this->sects->roots();
  }
  
}
?>
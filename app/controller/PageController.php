<?php
class PageController extends ApplicationController{
  public function controller_global(){
    if(($normal_layout = Request::param("test")) || ($normal_layout = Session::get("normal_layout"))){
      Session::set("normal_layout", $normal_layout);
      $this->cms();
    }else{
      $this->use_layout = "holding";
      $this->use_view = false;
    }
  }
  public function index(){}
  public function _top_nav(){
    $this->sects = new CmsSection;
    $this->sects = $this->sects->roots();
  }
  
}
?>
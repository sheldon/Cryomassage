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
    $this->sects = new CmsSection;
    $this->sects = $this->sects->roots();

    $this->bookingform = new WaxForm;
    $this->bookingform->add_element("name", "TextInput");
    $this->bookingform->add_element("email_address", "TextInput");
    
    if(($this->results = $this->bookingform->save()) && !$_POST['dontfillthisin']){
      $email = new WaxEmail;
      $email->add_to_address("sheldon.els@gmail.com", "sheldon");
      $email->add_bcc_address("pawel@cryomassage.co.uk", "pawel");
      $email->subject = "New booking from website";
      $email->body = "Details from the form:\n";
      foreach ($this->results as $key => $val) $email->body .= "\n$key : $val";
      $email->send();
    }
  }
  public function index(){}
}
?>
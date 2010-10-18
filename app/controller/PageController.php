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
      $email->from = "pawel@cryomassage.co.uk";
      $email->from_name = "CryoMassage Website";
      $email->add_to_address("pawel@cryomassage.co.uk", "pawel");
      $email->add_to_address("cryomassage@gmail.com", "pawel");
      $email->add_to_address("ciecier2@poczta.onet.pl", "pawel");
      $email->add_bcc_address("sheldon.els@gmail.com", "sheldon");
      $email->subject = "New booking from CryoMassage website - ".$this->results["name"];
      $email->body = "Details from the form:\n";
      foreach ($this->results as $key => $val) $email->body .= "\n$key : $val";
      $email->send();
    }
  }
  
  public function index(){
    $this->homepage = new CmsContent("published");
    $this->homepage = $this->homepage->filter("title","Homepage")->first();
  }
}
?>
<?php
class PageController extends ApplicationController{
  public function controller_global(){
    $this->cms();

    $this->sects = new CmsSection;
    $this->sects = $this->sects->roots()->order("date_modified")->all();

    $this->bookingform = new WaxForm;

    $this->bookingform->add_element("name", "TextInput", array("validations"=>array("required"), "label"=>"Name *"));
    $this->bookingform->add_element("address", "TextInput", array("validations"=>array("required"), "label"=>"Address *"));
    $this->bookingform->add_element("postcode", "TextInput", array("validations"=>array("required"), "label"=>"Postcode *"));
    $this->bookingform->add_element("type_of_enquiry", "SelectInput", array("validations"=>array("required"), "label"=>"Type of Enquiry *", "choices"=>array(""=>"","Relaxation Massage"=>"Relaxation Massage", "Sport Massage"=>"Sport Massage", "Remedial Massage"=>"Remedial Massage", "Other"=>"Other")));
    $this->bookingform->add_element("contact_telephone_number", "TextInput", array("validations"=>array("required"), "label"=>"Contact Telephone Number *"));
    $this->bookingform->add_element("additional_information", "TextareaInput", array("label"=>"Additional Information"));
    
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
<?php
//echo phpinfo();



if(extension_loaded('soap')){
    $client = new SoapClient("http://api.radioreference.com/soap2/?wsdl&v=latest");
    
    $countries =$client->getCountryList();
    foreach ($countries as $country){
        echo '<h4> country : '.$country->countryName.'</h4>';
        echo '<h4> country : '.$country->countryCode.'</h4>';
    }phpinfo();

}else{
    die('soap is not loaded');
}

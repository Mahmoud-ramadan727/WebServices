<?php
    ini_set('memory_limit','-1');
    $js_file_content = file_get_contents("/home/ahmed/web services/Labs/Day01/Help/resources/city.list.json");
    //var_dump($js_file_content);
    $js_city = json_decode($js_file_content,true);
  
    
   $city= array_filter($js_city, function($v){
        
        return $v['country']=='EG';
            
        
        
     });
   // var_dump($city);

    //var_dump(array_filter($js_city));
  if(isset($_POST["submit"])){

   
      $apiKey = '6856b47ba95da85b7f0b654584f64b33';
        $city_id = $_POST["city"];
        $apiURL = "http://api.openweathermap.org/data/2.5/weather?id=".$city_id."&lang=en&units=metric&APPID=6856b47ba95da85b7f0b654584f64b33";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_URL,$apiURL);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response,true);
        echo '<pre>';
        var_dump($data);
        echo  '</pre>';
        $day = date('l');
        $time = date("h:i:sa");
       
    }
     
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lab 1</title>
</head>
<body>
    <form action="" method="POST">
        <select name="city" >
        <?php
        foreach($city as $v=>$k){
             echo '<option value='.$k['id'].">".$k['name'].'</option>';
            }
        ?>
        </select>
        <input name="submit" type="submit" value="SUBMIT">
    </form>
    <?php 
   
      echo '<h3>' .$data['name'] .'</h3>';
      echo '<h3>' .$day .' '.$time.'</h3>';
      echo '<h3>'.date('y/m/d').'</h3>';
      echo '<h3>'.$data["weather"]['0']['description'].'</h3>';
      echo '<h3>' .$data['main']['temp'] .' c'.'</h3>';
      echo '<h3>' .' humidity  '.$data['main']['humidity'].' %'. '</h3>';
      echo '<h3>' .'wind : '.$data['wind']['speed'] .' km/h'.'</h3>';
    ?>
    
</body>
</html>

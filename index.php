<?php 
include 'dbconnect.php';
// if($db){
//   echo "ok";
// }else{
//   echo "on";
// }
$i=1;
$file = fopen('card.csv', 'r');
while (($line = fgetcsv($file)) !== FALSE) {
  // echo "<pre>";
  if($i==1){
    $data = explode("|", $line[0].$line[1].$line[2].$line[3].$line[4].$line[5]);
    $i++;
  } else {
    $data = explode("|", $line[0]);
    $i++;
  }
  
  unset($data[0],$data[16],$data[17]);
  str_replace( array('(', ')'), '', $data[10]);
  // print_r($data);

  // $account = $data[3]; 
  // $uniq = $data[6]; 
  // $phone = str_replace(str_split('()'), '', "$data[10]");


  //  $sql=$db->query("INSERT INTO `csv`.`csv_data_load` (`account`,`uniq`,`phone`) VALUES ('$account','$uniq','$phone')");
  // if ($sql) {
  //   echo "Insert Success";
  // }else{
  //   echo "Something is Wrong";
  // }
  // echo $account;
  // echo "<pre>";
  // echo $uniq;
  // echo "<pre>";
  // echo $phone;



// echo $data[3]."--".$data[6]."<br>";
  //echo $csvdata;

}
fclose($file);
?>


<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

  <div class="container">
    <form>
        <div class="row">
          <div class=col-sm-2>
            <label class="control-label" for="phoneAddFld">CSV UPLOAD:</label>
          </div>
        <div class="form-control col-sm-3">
            <input type="file" id="file" name="file" placeholder="Enter Your csv file">
        </div>
      <div class="col-sm-2">
      <div class="form-actions" style="background: white;"> 
       <button type="submit" class="btn btn-success" name="uploads" id="upload" style="background: green;">uploads</button>     </div>
   </div>
 </div>
</form>
 </div>

</body>
</html>


<script type="text/javascript">
$('#upload').on('click', function() {
  var file_data = $('#file').prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);
  $.ajax({
          url:'csv_upload.php', // point to server-side PHP script
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(response){
            console.log(response);
            alert(response);
            // document.getElementById("file").reset();   
          }
        });
});

</script>


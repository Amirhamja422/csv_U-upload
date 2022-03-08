<?php
    include 'libs/database.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_FILES['file'])){
       // Allowed mime types
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        // Validate whether selected file is a CSV file
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

            // If the file is uploaded
			if(is_uploaded_file($_FILES['file']['tmp_name'])){

                // Open uploaded CSV file with read-only mode
				
				$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                 // print_r($csvFile);
                // Skip the first line
				print_r(fgetcsv($csvFile));
                 // $row = 0;
                // Parse data from CSV file line by line
				while (($line = fgetcsv($csvFile)) !== FALSE) {
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

					$account = $data[3]; 
					$uniq = $data[6]; 
					$phone = str_replace(str_split('()'), '', "$data[10]");


					$sql=$db->query("INSERT INTO `csv`.`csv_data_load` (`account`,`uniq`,`phone`) VALUES ('$account','$uniq','$phone')");
					if ($sql) {
						echo "Insert Success";
					}else{
						echo "Something is Wrong";
					}
  // echo $account;
  // echo "<pre>";
  // echo $uniq;
  // echo "<pre>";
  // echo $phone;



// echo $data[3]."--".$data[6]."<br>";
  //echo $csvdata;

				}
                // Close opened CSV file
				// echo $status;
				fclose($csvFile);				
			}else{
				echo "Failed to Upload file";
			}
		}else{
			echo "invalid file type ";
		}
	}else{
		echo "No file selected..";
	}
}else{
	echo "Not a vailid Method";
}
?>
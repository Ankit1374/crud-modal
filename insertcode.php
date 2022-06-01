<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

function input_data($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
  }  

  $empErr = $fnameErr = $lnameErr = $deptErr = $contactErr = $photoErr = $desgErr = $salaryErr = $file_size = "";
  $valid_file_size = 3*1024*1024 ;

if(isset($_POST['insertdata']))
{
    if (empty($_POST["emp"])) {  
            echo $empErr = "Employee no is required";  exit;
    } else {  
        $emp = input_data($_POST["emp"]);  
            // check if mobile no is well-formed  
        if (!preg_match ("/^[0-9]+$/", $emp) ) {  
        echo $empErr = "Only numeric value is allowed.";  exit;
        }  
    }

    if (empty($_POST["fname"])) {  
       echo $fnameErr = "First Name is required";  exit;
    } else {  
       $fname = input_data($_POST["fname"]);  
           // check if name only contains letters and whitespace  
           if (!preg_match("/^[a-zA-Z]+$/",$fname)) {  
            echo $fnameErr = "Only alphabets and white space are allowed";  exit;
           }  
    }  

   if (empty($_POST["lname"])) {  
        echo $lnameErr = "Last Name is required";  exit;
    } else {  
       $lname = input_data($_POST["lname"]);  
           // check if name only contains letters and whitespace  
           if (!preg_match("/^[a-zA-Z]+$/",$lname)) {  
            echo $lnameErr = "Only alphabets and white space are allowed";  exit;
           }  
    }  

    if (empty($_POST["dept"])) {  
        echo $nameErr = "Department is required";  exit;
    } else {  
    $dept = input_data($_POST["dept"]);  
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z]+$/",$dept)) {  
            echo $nameErr = "Only alphabets and white space are allowed";  exit;
        }  
    }  

        if (empty($_POST["contact"])) {  
            echo $contactErr = "Mobile no is required";  exit;
    } else {  
        $contact = input_data($_POST["contact"]);  
            // check if mobile no is well-formed  
        if (!preg_match ("/^[0-9]{10}$/", $contact) ) {  
        echo $contactErr = "Only numeric value is allowed.";  exit;
        }  
        //check mobile no length should not be less and greator than 10  
        // if (strlen ($contact) != 10) {  
        //     echo $contactErr = "Mobile no must contain 10 digits.";  exit;
        //     }  
    }  

    if (empty($_POST["desg"])) {  
        echo $desgErr = "Designation is required";  exit;
    } else {  
    $desg = input_data($_POST["desg"]);  
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z]+$/",$desg)) {  
            echo $desgErr = "Only alphabets and white space are allowed";  exit;
        }  
    }  

    if (empty($_POST["salary"])) {  
            echo $salaryErr = "Salary is required";  exit;
    } else {  
        $salary = input_data($_POST["salary"]);  
            // check if mobile no is well-formed  
        if (!preg_match ("/^[0-9]+$/", $salary) ) {  
        echo $salaryErr = "Only numeric value is allowed.";  exit;
        }  
    }


    if(empty($_FILES['photo']['name'])){
        echo "Please Upload a image"; exit;
    }else{
        $photo = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];

        $imageFileType = strtolower(pathinfo($photo,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
    

        if($file_size > $valid_file_size)
        {
            echo $photoErr ="* File size must not be more that 3Mb.</br>";
        }

        if( in_array($imageFileType,$extensions_arr) )
        {
            move_uploaded_file($_FILES["photo"]["tmp_name"],'upload/'.$photo);
        }
        else{
            echo " File extension is incorrect";   exit;
        }
    }
   

    $query = "INSERT INTO records (emp,fname,lname,dept,contact,photo,desg,salary) VALUES ('$emp','$fname','$lname','$dept','$contact','$photo','$desg','$salary')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: index.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
?>
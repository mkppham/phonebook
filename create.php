<?php
global $link;
require_once 'config.php';

$name = $phone = "";
$name_err = $phone_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "Please enter a name";
    } elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z' -.\s]+$/")))){
        $name_err = 'Invalid name';
    }else{
        $name= $input_name;
    }

    $input_phone = trim($_POST["email"]);
    if(empty($input_phone)){
        $email_err = 'Please enter an Email.';
    } else{
        $phone = $input_phone;
    }
    if (empty($name_err) && empty($phone_err)){
        $sql = "INSERT INTO `students` (name, email) VALUES (?,?)";

        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_phone);

            $param_name = $name;
            $param_phone = $phone;

            if (mysqli_stmt_execute($stmt)){
                header("location:index.php");
                exit();
            } else{
                echo "Something went WRONG";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<!DOCTYPE  html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Create Record</h2>
                </div>
                <p>Fill this form and submit to add phone record to the database</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        </label>
                        <span class="help-block"><?php echo $name_err?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($phone_err))? 'has-error' : '';?>">
                        <label>phone</label>
                        <label>
                            <textarea name="phone" class="form-control"><?php echo $phone;?></textarea>
                        </label>
                        <span class="help-block"><?php echo $phone_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
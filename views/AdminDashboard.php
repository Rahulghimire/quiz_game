<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
            <?php
              // $data = $_SESSION; 
              // print_r($data);
                $status = $this->session->flashdata('success');
                if($status){
                    echo '<div class="alert alert-success alert-dismissible fade show zindex" role="alert">' . $status . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>';
                }
            ?>
    <p>This is admin dashboard</p>
</body>
</html>
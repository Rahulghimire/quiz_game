<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header-1.php'); ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <title>Admin Dashboard</title>
    <style>
      *{
        margin:0;
        padding:0;
        box-sizing: border-box;
	      font-family: "Roboto", sans-serif;
      }
      .navbar
      {
          background:#00796B;
          border-bottom-color: #004D40;
      }
      li{
        list-style: none;
        padding:0 10px;
      }

      a{
        text-decoration:none;
        color:white;
      }

    a:hover{
      color:white;
    }

    .zindex{
          z-index: 1;
          width:30%;
          position: absolute;
          top:0;
          left:0;
    }

    .table {
    font-size: 14px;
    border-radius: 2px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }

  .table thead th {
  background-color: #007bff;
  color: #fff;
  font-weight: 600;
  text-align: center;
  vertical-align: middle;
}

.table th {
    vertical-align: middle;
    text-align: center;
}

.table tbody td {
  text-align: center;
  vertical-align: middle;
}
.modal-header{
  border:none;
}
.modal-footer{
  border:none;
}
</style>
</head>
<body>
<?php
   $status = $this->session->flashdata('success');
    if($status){
    echo '<div class="alert alert-success alert-dismissible fade show zindex" role="alert">' . $status . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button></div>';
}
?> 
<nav class="navbar justify-content-between">
  <a class="navbar-brand text-white fw-bold">Dashboard</a>
  <form class="form-inline">
  <li><a  href="#"><i class="fa fa-user-circle"></i> Admin <span class="caret"></span></a></li>
  <li><a href="<?php base_url()?>Admin/logout"><i class="fa fa-sign-out"></i> Logout</a></li>  
  </form>
</nav> 
<section class="my-4 mx-2">
<div class="table-responsive-sm table-responsive-md">
  <table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">SN</th>
      <th scope="col">User Name</th>
      <th scope="col">Total Questions</th>
      <th scope="col">Correct / Attempted Questions</th>
      <th scope="col">Begin date time</th>
      <th scope="col">Total time consumed</th>
      <th scope="col">Action</th>      
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($rows)) {foreach($rows as $row){?>
     <tr id="row-<?php echo $row['test_id'] ?>">
      <th scope="row"><?php echo $row['test_id'] ?></th>
      <td><?php echo $row['name']?></td>
      <td><?php echo $row['total_questions'] ?></td>
      <td><span><?php echo $row['correct_questions'] ?></span><span>/</span><span><?php echo $row['attempted_questions'] ?></span></td>
      <td><?php echo $row['begin_date_time'] ?></td>
      <td><?php echo $row['total_time_taken'] ?><span> secs</span></td>
      <td><button type="button" class="btn btn-info" onclick="showPreview(<?php echo $row['test_id']?>)" data-toggle="modal" data-target="#previewModal">Preview</button></td>
    </tr>
<?php }} else{ ?>
    <tr class="text-info">
      <th>Records Not Found!!</th>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div> 
</section>
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title border-none" id="previewModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">User Id</th>
      <th scope="col">Questions</th>
      <th scope="col">Selected Answers</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
  
  </tbody>
</table>
      </div>
      <div class="modal-footer border-none">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

  // $(document).ready(function(){
  //   console.log("Yes ready");
  //   $.ajax({
  //       url:'<?php echo base_url().'index.php/Admin/'?>',
  //       type:'post',
  //       data:{},
  //       dataType:'json',
  //       success:function(response){
  //       console.log(response);
  //       },

  //       error:function(){
  //       console.log("error");
  //       },

  //       complete:function(){
  //       console.log("request completed");
  //       }
  //   });

  // });
  
  function showPreview(id){
      console.log(id);
    }

</script>

</body>
</html>
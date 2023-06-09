<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header-1.php'); ?>
    <link rel="stylesheet" href="<?php echo base_url().'assets/styles/admin-dash.css'?>">
    <title>Admin Dashboard</title>
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
  <a class="navbar-brand text-white fw-bold">Admin Dashboard</a>
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
      <div class="modal-body">
      <table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Questions</th>
      <th scope="col">Selected Answers</th>
      <th scope="col">Correct Answers</th>
      <th scope="col">Time Taken</th>
    </tr>
  </thead>
  <tbody id="table-body">
  </tbody>
</table>
      </div>
    </div>
  </div>
</div>

<script>

setTimeout(function() {
    $('.alert').alert('close');
  }, 1200);

  function showPreview(id){
    $('#table-body').empty();
      console.log(id);
      $.ajax({
        url:'<?php echo base_url().'index.php/Admin/getPreviewResult/'?>'+id,
        type:'post',
        dataType:'json',
          success: function(response) {
          var tableBody = $('#table-body');

          if (response) {
            for (let i = 0; i < response[0].total_questions; i++) {
              var optionsSelected = JSON.parse(response[0].options_selected);
              var correctAnswers = JSON.parse(response[0].correct_answers);
              var timeStorage = JSON.parse(response[0].time_storage);
              var questionsText = JSON.parse(response[0].questions_text);
              console.log(correctAnswers, questionsText);

              var row = $('<tr>');
              var question = questionsText[i];
              var option = optionsSelected[i];
              var corrAns = correctAnswers[i];
              var time = timeStorage[i];

              var timeString = time + ' secs';

              if (option == corrAns && option != 0) {
                row.addClass('bg-success text-white');
              } else if (option != corrAns) {
                row.addClass('text-danger');
              } else {
                row.addClass('bg-secondary text-white');
              }
              if(question!=0){
              row.append($('<td>').text(i+1));
              row.append($('<td>').text(question));
              row.append($('<td>').text(option));
              row.append($('<td>').text(corrAns));
              row.append($('<td>').text(timeString));
              tableBody.append(row);
              }
            }
          }
        },
        error:function(){
        console.log("error");
        },

        complete:function(){
        console.log("request completed");
        }
      });
    }

</script>
</body>
</html>
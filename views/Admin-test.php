<style>
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

.table tbody td {
  text-align: center;
  vertical-align: middle;
}

.table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.table tbody tr:hover {
  background-color: #f5f5f5;
}
</style>
<tr>
    <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td><button type="button" class="btn btn-info" onclick="showPreview()">Preview</button></td>
    </tr>
<tbody>
    <?php if(!empty($rows)) {foreach($rows as $row){?>
     <tr id="row-<?php echo $row['test_id'] ?>">
      <th scope="row"><?php echo $row['test_id'] ?></th>
      <td><?php echo $row['name']?></td>
      <td><?php echo $row['total_questions'] ?></td>
      <td><span><?php echo $row['correct_questions'] ?></span><span>/</span><span><?php echo $row['attempted_questions'] ?></span></td>
      <td><?php echo $row['begin_date_time'] ?></td>
      <td><?php echo $row['total_time_taken'] ?></td>
      <td><button type="button" class="btn btn-info" onclick="showPreview(<?php echo $row['id']?>)">Preview</button></td>
    </tr>
<?php }} else{ ?>
    <tr class="text-info">Records Not Found!!</tr>
    <?php } ?>
  </tbody>
<div>
public function index()
	{
		$this->load->view("header");
		$this->load->model('User_model');
		$rows=$this->User_model->all();
		$data['rows']=$rows;
		$this->load->view('list',$data);	
	}

  public function all(){
       return $result=$this->db->order_by('id','ASC')->get('users')->result_array();
    }

</div>
 

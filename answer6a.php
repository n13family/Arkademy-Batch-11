<?php
error_reporting(0);
$con = new mysqli("localhost", "root", "", "ark");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

if(isset($_POST['type']))
{
	$type = $_POST['type'];

		$name = $_POST['name'];
		$work = $_POST['work'];
		$salary = $_POST['salary'];
		if($type == 1)
		{
			$id = $con->query("SELECT * From name")->num_rows + 1;
			$addQuery = "INSERT INTO `name` (`id`, `name`, `id_work`, `id_salary`) VALUES ('$id', '$name', '$id', '$id')";
			$addWorkQuery = "INSERT INTO `work` (`id`, `id_salary`, `name`) VALUES ('$id', '$id', '$work')";
			$addSalaryQuery = "INSERT INTO `kategori` (`id`, `salary`) VALUES ('$id', '$salary')";
		if($con->query($addQuery) == false)
		{
				die('{"success":0, "msg":"CANNOT ADD NAME"}');
		}
		else if($con->query($addWorkQuery) == false)
		{
				die('{"success":0, "msg":"CANNOT ADD WORK"}');
		}
		else if($con->query($addSalaryQuery) == false)
		{
				die('{"success":0, "msg":"CANNOT ADD SALARY"}');
		}
		else
		{
				die('{"success":1, "id":'.$id.'}');
		}
		}

		$id = $_POST['id'];
		if(strlen($id) == 0)
		{
			die('{"success":0, "msg":"PLEASE REFRESH THE PAGE"}');
		}
		if($type == 3)
		{
		$deleteName = "DELETE FROM name WHERE id='$id'";
		$deleteWork = "DELETE FROM work WHERE id='$id_work'";
		$deleteSalary = "DELETE FROM kategori WHERE id='$id_salary'";
		if($con->query($deleteName) == false)
		{
				die('{"success":0, "msg":"CANNOT DELETE NAME"}');
		}
		else if($con->query($deleteWork) == false)
		{
				die('{"success":0, "msg":"CANNOT DELETE WORK"}');
		}
		else if($con->query($deleteSalary) == false)
		{
				die('{"success":0, "msg":"CANNOT DELETE SALARY"}');
		}
		else
		{
				die('{"success":1}');
		}
	}
		
		$userQuery = "SELECT * From name WHERE id='$id'";
		$getUser = $con->query($userQuery);
		if($getUser->num_rows == 0)
		{
			die('{"success":0, "msg":"ID NOT FOUND"}');
		}
		$dataUser = $getUser->fetch_assoc();
		$id_work = $dataUser['id_work'];
		$id_salary = $dataUser['id_salary'];
	if($type == 2)
	{
		$queryName = "UPDATE name SET name='$name' WHERE id='$id'";
		$queryWork = "UPDATE work SET name='$work' WHERE id='$id_work'";
		$querySalary = "UPDATE kategori SET salary='$salary' WHERE id='$id_salary'";
		if($con->query($queryName) == false)
		{
				die('{"success":0, "msg":"CANNOT UPDATE NAME"}');
		}
		else if($con->query($queryWork) == false)
		{
				die('{"success":0, "msg":"CANNOT UPDATE WORK"}');
		}
		else if($con->query($querySalary) == false)
		{
				die('{"success":0, "msg":"CANNOT UPDATE SALARY"}');
		}
		else
		{
				die('{"success":1}');
		}

	}
	die("Error");
}

$query = "SELECT * From name";
$get = $con->query($query);

while ($row = $get->fetch_assoc()) 
{
	$array[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Table with Add and Delete Row Feature</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    body {
        color: #404E67;
        background: #F5F7FA;
		font-family: 'Open Sans', sans-serif;
	}
	.table-wrapper {
		width: 700px;
		margin: 30px auto;
        background: #fff;
        padding: 20px;	
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
		height: 30px;
		font-weight: bold;
		font-size: 12px;
		text-shadow: none;
		min-width: 100px;
		border-radius: 50px;
		line-height: 13px;
    }
	.table-title .add-new i {
		margin-right: 4px;
	}
    table.table {
        table-layout: fixed;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
		cursor: pointer;
        display: inline-block;
        margin: 0 5px;
		min-width: 24px;
    }    
	table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table td a.add i {
        font-size: 24px;
    	margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
	table.table .form-control.error {
		border-color: #f50000;
	}
	table.table td .add {
		display: none;
	}
	input[type=text], select {
	  width: 100%;
	  padding: 12px 20px;
	  margin: 8px 0;
	  display: inline-block;
	  border: 1px solid #ccc;
	  border-radius: 4px;
	  box-sizing: border-box;
	}
</style>
<script type="text/javascript">
function add()
{
Swal.fire({
		title: 'Edit',
		html: '<input type="text" id="newName" placeholder="Name">' +
		'<select name="work" id="newWork">'+
		'<option value="Frontend Dev">Frontend Dev</option>'+
  		'<option value="Backend Dev">Backend Dev</option>'+
		'</select>' +
		'<input type="text" id="newSalary" placeholder="Salary">',
		confirmButtonText: 'Add',
		showCancelButton: true,
		cancelButtonText: 'Cancel',
	  	showLoaderOnConfirm: true,
		preConfirm: (amount) => {
			var newName = $('#newName').val();
			var newWork = $('#newWork').val();
			var newSalary = $('#newSalary').val();
			$.post('',{type: 1, name:newName, work:newWork, salary:newSalary}, function(result) {
						var res = JSON.parse(result)
					if(res.success == 1)
					{
						var id = res.id;
						Swal.fire('SUCCESS ADDED TO DATABASE', '', 'success')
						document.getElementById('worker').innerHTML += ''+
'                    <tr id="line'+id+'">'+
'                        <td id="name'+id+'">'+newName+'</td>'+
'                        <td id="work'+id+'">'+newWork+'</td>'+
'                        <td id="salary'+id+'">'+newSalary+'</td>'+
'                        <td>'+
'                            <a class="edit" title="Edit" data-toggle="tooltip" onclick="edit('+id+')"><i class="material-icons">&#xE254;</i></a>'+
'                            <a class="delete" title="Delete" data-toggle="tooltip" onclick="deleted('+id+')"><i class="material-icons">&#xE872;</i></a>'+
'                        </td>'+
'                    </tr>';
					}
					else if(res.success == 0)
					{
						Swal.fire('FAILED', res.msg, 'error')
					}
					else 
					{
						Swal.fire('FAILED', 'UNKNOWN ERROR', 'error')
					}
			});
		}

	})
}
function edit(id)
{
	var name = document.getElementById('name'+id).innerHTML;
	var work = document.getElementById('work'+id).innerHTML;
	var salary = document.getElementById('salary'+id).innerHTML;
	if(work == "Frontend Dev")
	{
		var workName = 'Backend Dev';
	}
	else
	{
		var workName = 'Frontend Dev';
	}
	Swal.fire({
		title: 'Edit',
		html: '<input type="text" id="newName" value="'+name+'" placeholder="Name">' +
		'<select name="work" id="newWork">'+
		'<option value="' + work + '">' + work + '</option>'+
  		'<option value="' + workName + '">' + workName + '</option>'+
		'</select>' +
		'<input type="text" id="newSalary" value="'+salary+'" placeholder="Salary">',
		confirmButtonText: 'Edit',
		showCancelButton: true,
		cancelButtonText: 'Cancel',
	  	showLoaderOnConfirm: true,
		preConfirm: (amount) => {
			var newName = $('#newName').val();
			var newWork = $('#newWork').val();
			var newSalary = $('#newSalary').val();
			$.post('',{type: 2, id: id, name:newName, work:newWork, salary:newSalary}, function(result) {
						var res = JSON.parse(result)
					if(res.success == 1)
					{
						Swal.fire('SUCCESS EDITED', '', 'success')
						document.getElementById('name'+id).innerHTML = newName;
						document.getElementById('work'+id).innerHTML = newWork;
						document.getElementById('salary'+id).innerHTML = newSalary;
					}
					else if(res.success == 0)
					{
						Swal.fire('FAILED', res.msg, 'error')
					}
					else 
					{
						Swal.fire('FAILED', 'UNKNOWN ERROR', 'error')
					}
			});
		}

	})
}
function deleted(id)
{
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
			$.post('',{type: 3, id: id}, function(result) {
						var res = JSON.parse(result)
					if(res.success == 1)
					{
						Swal.fire('Succes deleted' + document.getElementById('name'+id).innerHTML +' from database', '', 'success')
						$('#line'+id).html("");
					}
					else if(res.success == 0)
					{
						Swal.fire('FAILED', res.msg, 'error')
					}
					else 
					{
						Swal.fire('FAILED', 'UNKNOWN ERROR', 'error')
					}
			});
  }
})	
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Employee <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new" onclick="add()"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Work</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="worker"><?php
foreach ($array as $key => $value) 
{
	
	$id = $array[$key]['id'];
	$name = $array[$key]['name'];
	$id_work = $array[$key]['id_work'];
	$id_salary = $array[$key]['id_salary'];
	// id name id_work id_salary
	$queryWork = "SELECT * From work WHERE id='$id_work'";
	$getWork = $con->query($queryWork);

	$rowWork = $getWork->fetch_assoc();
	
	$work = $rowWork['name'];

	$querySalary = "SELECT * From kategori WHERE id='$id_salary'";
	$getSalary = $con->query($querySalary);

	$rowSalary = $getSalary->fetch_assoc();
	$salary = $rowSalary['salary'];

	echo '

                    <tr id="line'.$id.'">
                        <td id="name'.$id.'">'.$name.'</td>
                        <td id="work'.$id.'">'.$work.'</td>
                        <td id="salary'.$id.'">Rp. '.$salary.'</td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip" onclick="edit('.$id.')"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip" onclick="deleted('.$id.')"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
      ';


}
?>
      
                </tbody>
            </table>
        </div>
    </div>     
</body>
</html>                            
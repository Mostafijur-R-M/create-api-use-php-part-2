<?php

	header('content-type: application/json');

		$request = $_SERVER['REQUEST_METHOD'];

		switch ($request) {
			case 'GET':
				getmethod();
				break;
			case 'POST':
				$data = json_decode(file_get_contents('php://input'),true);
				postmethod($data);
				break;
			case 'PUT':
				$data = json_decode(file_get_contents('php://input'),true);
				putmethod($data);
				break;
			case 'DELETE':
				$data = json_decode(file_get_contents('php://input'),true);
				deletemethod($data);
				break;
			
			default:
				echo "data not found";
				break;
		}

		function getmethod(){
			include "db.php";
			$sql = "SELECT * FROM darkcoder";
			$result = mysqli_query($conn,$sql);

			if (mysqli_num_rows($result) > 0) {
				$rows=array();
				while ($r = mysqli_fetch_assoc($result)){

					$rows["result"] [] = $r;
				}
				echo json_encode($rows);
			}else{
				echo '{"result": "no data found"}';
			}
		}

		function postmethod($data){
			include "db.php";
			$name = $data["name"];
			$email = $data["email"];
			
			$sql = "INSERT INTO darkcoder(name, email, created_at) VALUES('$name', '$email', NOW())";

			if (mysqli_query($conn, $sql)) {
				echo '{"result": "data insterted"}';
			}else{
				echo '{"result": "data not inserted"}';
			}
		}

		function putmethod($data){

			include 'db.php';
			$id = $data["id"];
			$name = $data["name"];
			$email = $data["email"];

			$sql = "UPDATE darkcoder SET name = '$name', email = '$email', created_at = NOW() where id = '$id'";

			if (mysqli_query($conn, $sql)) {
				echo '{"result": "data edited"}';
			}else{
				echo '{"result": "data not edited"}';
			}
		}

		function deletemethod($data){

			include 'db.php';
			$id = $data["id"];

			$sql = "DELETE FROM darkcoder where id = $id";

			if (mysqli_query($conn, $sql)) {
				echo '{"result": "data deleted"}';
			}else{
				echo '{"result": "data not deleted"}';
			}
		}
?>
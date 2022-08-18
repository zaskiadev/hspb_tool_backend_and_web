<?php

//fetch_data.php
$output[] = array();

$serverName = "127.0.0.1,5000";
$connectionInfo = array( "Database"=>"working_order_hspb", "UID"=>"edpbintaro", "PWD"=>"sqledpbintaro123", "ReturnDatesAsStrings"=>true);
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
  die( print_r( sqlsrv_errors(), true));
}

$method = $_SERVER['REQUEST_METHOD'];


if($method == 'POST') {
$sql="";
$filter_by = "";
$date_range_start="";
$date_range_finish="";
$dept_code="";

    if (isset($_POST['filter_by'])) {
        $filter_by = $_POST['filter_by'];
    }
    if (isset($_POST['date_range_start'])) {
        $date_range_start = $_POST['date_range_start'];
    }
    if (isset($_POST['date_range_finish'])) {
        $date_range_finish = $_POST['date_range_finish'];
    }
    if (isset($_POST['dept_code'])) {
        $dept_code = $_POST['dept_code'];
    }


    if($dept_code!="D0007") {
        if ($filter_by == "Show Only Not Finished Work Order") {


            $sql = "SELECT a.code_wo,a.user_wo_create, b.dept_name, a.date_wo_start, a.date_wo_end, a.skala, a.status, a.jenis_wo, c.code_wo_detail from table_wo as a 
inner join table_dept as b on  a.code_dept_wo_request=b.dept_code 
inner join table_wo_detail as c on a.code_wo=c.code_wo
where a.status!='finish' AND a.code_dept_wo_request='$dept_code' order by a.code_wo desc";


        } elseif ($filter_by == "Show All Work Order") {

            $sql="SELECT a.code_wo,a.user_wo_create, b.dept_name, a.date_wo_start, a.date_wo_end, a.skala, a.status, a.jenis_wo, c.code_wo_detail from table_wo as a 
inner join table_dept as b on  a.code_dept_wo_request=b.dept_code 
inner join table_wo_detail as c on a.code_wo=c.code_wo
where a.code_dept_wo_request='$dept_code' order by a.code_wo desc";
        } else
        {
            $sql="SELECT a.code_wo,a.user_wo_create, b.dept_name, a.date_wo_start, a.date_wo_end, a.skala, a.status, a.jenis_wo, c.code_wo_detail from table_wo as a 
inner join table_dept as b on  a.code_dept_wo_request=b.dept_code 
inner join table_wo_detail as c on a.code_wo=c.code_wo
 where $date_range_start>=a.date_wo_start and $date_range_finish<=a.date_wo_start and a.code_dept_wo_request='$$dept_code' order by a.code_wo desc ";
        }
}
    else
    {
        if ($filter_by == "Show Only Not Finished Work Order") {


            $sql = "SELECT a.code_wo,a.user_wo_create, b.dept_name, a.date_wo_start, a.date_wo_end, a.skala, a.status, a.jenis_wo, c.code_wo_detail from table_wo as a 
inner join table_dept as b on  a.code_dept_wo_request=b.dept_code 
inner join table_wo_detail as c on a.code_wo=c.code_wo
 where a.status!='finish' order by a.code_wo desc ";


        } elseif ($filter_by == "Show All Work Order") {

            $sql="SELECT a.code_wo,a.user_wo_create, b.dept_name, a.date_wo_start, a.date_wo_end, a.skala, a.status, a.jenis_wo, c.code_wo_detail from table_wo as a 
inner join table_dept as b on  a.code_dept_wo_request=b.dept_code 
inner join table_wo_detail as c on a.code_wo=c.code_wo
w order by a.code_wo desc ";

        } else
        {
            $sql="SELECT a.code_wo,a.user_wo_create, b.dept_name, a.date_wo_start, a.date_wo_end, a.skala, a.status, a.jenis_wo, c.code_wo_detail from table_wo as a 
inner join table_dept as b on  a.code_dept_wo_request=b.dept_code 
inner join table_wo_detail as c on a.code_wo=c.code_wo
where $date_range_start>=a.date_wo_start and $date_range_finish<=a.date_wo_start and a.code_dept_wo_request='$$dept_code' order by a.code_wo desc";
        }
    } 
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $output[] = $result;
    }
    header("Content-Type: application/json");
    echo json_encode(array('hasil' => $output));

}

?>

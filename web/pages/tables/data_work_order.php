
<?php


$filter_by="";

$output[] = array();

$serverName = "127.0.0.1,5000";
$connectionInfo = array( "Database"=>"working_order_hspb", "UID"=>"edpbintaro", "PWD"=>"sqledpbintaro123", "ReturnDatesAsStrings"=>true);
$conn = sqlsrv_connect( $serverName, $connectionInfo );

if( $conn === false ) {
  die( print_r( sqlsrv_errors(), true));
}
$filter_by="";

if(isset($_GET['filter_by'])){
  $filter_by=$_GET['filter_by'];
}
?>

  <?php
  require_once("dompdf/autoload.inc.php");





  /*require_once ('PHPExcel.php');

$excel = new PHPExcel();

$excel->getProperties()->setCreator('HSPB Tool Web')
             ->setLastModifiedBy('HSPB Tool Web')
             ->setTitle("Work Order Data")
             ->setSubject("Work Order Data")
             ->setDescription("Work Order Data")
             ->setKeywords("Work Order Data");


$excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Work Order"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1


$excel->setActiveSheetIndex(0)->setCellValue('A3', "Code WO"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "Wo Type"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "Priority"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('D3', "Departement Name"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->setActiveSheetIndex(0)->setCellValue('E3', "Item Name"); // Set kolom E3 dengan tulisan "TELEPON"
$excel->setActiveSheetIndex(0)->setCellValue('F3', "Location");
$excel->setActiveSheetIndex(0)->setCellValue('G3', "Wo Request");
$excel->setActiveSheetIndex(0)->setCellValue('H3', "Image"); // Set kolom F3 dengan tulisan "ALAMAT"

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
*/

	require_once('connection.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();
define("DOMPDF_ENABLE_REMOTE", false);
  if($filter_by=="Not_Finished_Work_Order") {


    $html = '<center><h3>Work Order (Not Finished Work Order)</h3></center><hr/><br/>';
    $html .= '<table border="1" width="100%">
            <tr>
                <th>Code Wo </th>
                <th>Jenis WO</th>
                <th>Skala</th>
                <th>Departemen Name</th>
                <th>Nama Barang</th>
                <th>Location</th>
                <th>WO Request</th>
                <th>Image Location</th>
            </tr>';
    $no = 1;

    $sql="SELECT a.code_wo as code_wo, a.jenis_wo as jenis_wo, a.skala as skala, b.dept_name as dept_name,e.nama_barang as nama_barang, e.location as location,c.wo_request as wo_request ,c.image_location as image_location FROM table_wo as a
  inner join table_dept as b on a.code_dept_wo_request=b.dept_code
  inner join table_wo_detail as c on a.code_wo=c.code_wo
  inner join table_maintenace as d on c.code_wo_detail=d.code_wo_detail
  inner join table_barang as e on d.code_barang=e.code_barang where a.status!='Finish' ORDER BY a.code_wo";



    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
    }
//$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4


    while ($result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {


      $html .= "<tr>
      <td>".$result['code_wo']."</td>
      <td>".$result['jenis_wo']."</td>
      <td>".$result['skala']."</td>
      <td>". $result['dept_name']."</td>
      <td>".$result['nama_barang']."</td>
      <td>".$result['location']."</td>
      <td>".$result['wo_request']."</td>"
      ;
  $no++;
 /*$excel->getActiveSheet()->setCellValue('A'.$numrow, $result['code_wo']);
  $excel->getActiveSheet()->setCellValue('B'.$numrow, $result['jenis_wo']);
   $excel->getActiveSheet()->setCellValue('C'.$numrow, $result['skala']);
    $excel->getActiveSheet()->setCellValue('D'.$numrow, $result['dept_name']);
     $excel->getActiveSheet()->setCellValue('E'.$numrow, $result['nama_barang']);
      $excel->getActiveSheet()->setCellValue('F'.$numrow, $result['location']);
       $excel->getActiveSheet()->setCellValue('G'.$numrow, $result['wo_request']);*/


        if(file_exists($result['image_location']))
      {
        $html .="<td> <img src='".$_SERVER['DOCUMENT_ROOT']."\hspb_tool\image_work_order\\".$result['image_location']."/></td>";

      }
      else
      {
          $html.="</tr>";
      }
 //$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);




    }

    $html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('letter', 'landscape');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_work_order.pdf');
  }
  elseif ($filter_by=="All_Work_Order")
  {
   $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4

  $sql = mysqli_query($CON,"SELECT a.code_wo as code_wo, a.jenis_wo as jenis_wo, a.skala as skala, b.dept_name as dept_name,e.nama_barang as nama_barang, e.location as location,c.wo_request as wo_request ,c.image_location as image_location FROM table_wo as a
  inner join table_dept as b on a.code_dept_wo_request=b.dept_code
  inner join table_wo_detail as c on a.code_wo=c.code_wo
  inner join table_maintenace as d on c.code_wo_detail=d.code_wo_detail
  inner join table_barang as e on d.code_barang=e.code_barang ORDER BY a.code_wo");

  while ($data = mysqli_fetch_assoc($sql)) {

    $excel->getActiveSheet()->setCellValue('A'.$numrow, $result['code_wo']);
  $excel->getActiveSheet()->setCellValue('B'.$numrow, $result['jenis_wo']);
   $excel->getActiveSheet()->setCellValue('C'.$numrow, $result['skala']);
    $excel->getActiveSheet()->setCellValue('D'.$numrow, $result['dept_name']);
     $excel->getActiveSheet()->setCellValue('E'.$numrow, $result['nama_barang']);
      $excel->getActiveSheet()->setCellValue('F'.$numrow, $result['location']);
       $excel->getActiveSheet()->setCellValue('G'.$numrow, $result['wo_request']);

        //if(file_exists($result['image_location']))
  //{


    //   $objDrawing = new PHPExcel_Worksheet_Drawing();
	//			$objDrawing->setName('Image');
	//			$objDrawing->setDescription('Image');
	//			$objDrawing->setImageResource($result['image_location']);
	//			$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
//$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
//$objDrawing->setHeight(150);
//				  $objDrawing->setCoordinates('H'.$numrow);
  //  $objDrawing->setWorksheet($objDrawing->getActiveSheet());

	//			}
	//			else
	//			{
	//				  $excel->getActiveSheet()->setCellValue('H'.$numrow, '');
	//			}
	//			-->


 $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);


  $numrow++; // Tambah 1 setiap kali looping

  }

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom F
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Data Work Order");
$excel->setActiveSheetIndex(0);
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Work Order.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
  }

  ?>


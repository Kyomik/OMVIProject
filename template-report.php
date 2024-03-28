<?php 
	function getTemplate($id_transaksi, $tgl_input, $tgl_priode, $total_harga, $nama_costumer, $negara_costumer, $no_telp_costumer, $nama_akun, $negara_akun, $no_telp_akun, $data_items){

		$tahun_sekarang = date('Y');
		$tanggal1 = $tgl_priode;
// Tanggal kedua
$tanggal2 = $tgl_input;

// Mengonversi tanggal ke format waktu UNIX
$waktu1 = strtotime($tanggal1);
$waktu2 = strtotime($tanggal2);

// Menghitung selisih dalam detik
$selisih_detik = $waktu1 - $waktu2;

// Menghitung selisih dalam hari
$selisih_hari = floor($selisih_detik / (60 * 60 * 24));
		$html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example 2</title>
    <style type="text/css">
      @font-face {
	  font-family: sans;
	  src: url(SourceSansPro-Regular.ttf);

	}
	*{
	  margin:0px;
	  padding:0px;
	}

	p{
		font-family:sans;
	}

	#con-ktk{
		width:100%; margin:auto; padding:40px;
		border-collapse:collapse;
		text-align:center;
	}

	.ktks{
		border:none;
	}

	.ktk, th, .ktk2, .ktk3{
		border:1px solid black;
		border-collapse:collapse;
	}
	
	.logo{
		float: left;
	}

	.text{
		float: right;
		position:relative;
		right:250px;
		top:25px;
	}

	.text > h5{
		font-weight: bold;
		font-size: 1em;
	}
    </style>
  </head>
  <body style="width:90%; border:1px solid green; margin:auto;">
    <table style="width:100%; padding: 40px;">
      <tr>
        <td>
        	<div class="logo">
           		<img src="http://localhost/OMVIProject/travelnew.png" style="width:100px; height:100px;">
           	</div>
        	<div class="text">
        		<h5>SINGAPORE <br>TRANSPORTATION <br>SERVICE</h5>
        	</div>
        </td>
        <td>
            <p style="position: relative; bottom: 75px; right:100px; text-align: center; font-size:1em;"><b>INVOICE</b></p>
        </td>
      </tr>

      <tr>
        <td>
        	<p style="font-size:0.8em; position:relative; float:left;">Marbella 2 Residences Batam, Blk F15 No 10. Belian 29431 <br>The Metropolis Tower 2. 11 North Buona Vista Drive Unit #08-09 <br>Singapore 138589</p>
        	<p style="font-size:0.8em; position:relative; float:right; left: 20px;">' .  "#OMFAI  -  " . substr($tahun_sekarang, -2) . "   -   " . $id_transaksi .
        	'</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; padding: 40px;">
      <tr style="border:1px solid black; width:auto; height:auto;">
      	<p style="font-size:0.8em; position:relative;">PT. Omfai Jaya Mulya Wisata<br>Phone +62 821-7277-4251<br>Email : omfaitravel@gmail.com<br><a href="url" style="text-decoration:none;">www.sewamobilsingapore.com</a></p>
      	<p style="position:relative; bottom:80px; right:60px; font-size:0.8em; float:right;">
      	DATE :    ' . $tgl_input . '<br>
      	DUE DATE :   ' . $tgl_priode . '<br>
      	AMOUNT DUE : IDR ' . $total_harga . '</p>
      </tr><br>
      
      <tr>
      	<td>
      		<p style="position:relative; font-size:0.8em; float:left;">
      			<b>TO :</b><br>
      			Mr/Mrs,    ' . $nama_costumer . '<br>' . 
      			$negara_costumer . '<br>
      			Phone :  ' . $no_telp_costumer .
      		'</p>
      		<p style="position:relative; font-size:0.8em; float:right; right:60px;" >
      			<b>FROM :</b><br>
      			Mr. ' . $nama_akun . '<br>' .
      			$negara_akun . '<br>
      			Phone : ' . $no_telp_akun .
      		'</p>
      	</td>
      </tr>
    </table>

  	<table id="con-ktk">
  		<tr class="ktk">
	  		<th>Date</th>
	  		<th>Unit</th>
	  		<th>Item & Description</th>
			<th>Qty</th>
	  		<th>Rate</th>
	  		<th>Amount</th>
  		</tr>
  	';

  	$data_items = explode('|', $data_items);
  	$number = 1;
  	foreach ($data_items as $item) {
  		$detail_item = explode(',', $item);
  		$total = $detail_item[2] * $detail_item[3];
  		$html .= "
  			<tr class=`ktk`>
	  			<td class='ktk2'>" . $detail_item[1] . "</td>
	  			<td class='ktk2'>" . $number . "</td>
	  			<td class='ktk2'>" . $detail_item[0] . "</td>
	  			<td class='ktk2'>" . $detail_item[3] . "</td>
	  			<td class='ktk2'>" . number_format($detail_item[2]) . "</td>
	  			<td class='ktk2'>" . number_format($total) . "</td>
  			</tr>";
  		$number++;
  	}	
  			
	$html .= '<tr>
	  		<td class="ktks"></td>
	  		<td class="ktks"></td>
	  		<td class="ktks"></td>
	  		<td class="ktks"></td>
		  	<td class="ktks">TOTAL</td>
		  	<td class="ktk3">' . $total_harga . '</td>
	  	</tr>
  	</table>
  	<table style="width:100%; padding:40px;">
  		<tr>
  			<td>
  				<p style="font-size:0.8em; position:relative; float:left;">Payment transfer bank account Mandiri 1090020808275 Omfai Jaya Mulya Wisata Using IDR<br>currency. Payment is due within ' . $selisih_hari . ' days. If you Hve any question concerning this invoice, contact<br>OMFAITRAVEL +62 821-7277-4251 
  					<br><br>
  					Thank you for your bussiness!
  				</p><br><br><br><br>
  				<p style="font-size:0.8em; position:relative; float:right; right:20px;">
  				Hormat Kami<br>
  				<img src="http://localhost/OMVIProject/cap.png" style="width:80px; height:80px;">
  				<br>' . $nama_akun .
  				'</p>
  			</td>
  		</tr>
  	</table>
  </body>
</html>';
	
	return $html;
	}

?>
<?php
	require_once "vendor/autoload.php";

	 use Dompdf\Dompdf;
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
           		<img src="assets/img/user/travelnew.png" style="width:100px; height:100px;">
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
        	<p style="font-size:0.8em; position:relative; float:right; left: 20px;">#OMFI - 24 - 001</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; padding: 40px;">
      <tr style="border:1px solid black; width:auto; height:auto;">
      	<p style="font-size:0.8em; position:relative;">PT. Omfai Jaya Mulya Wisata<br>Phone +62 821-7277-4251<br>Email : omfaitravel@gmail.com<br><a href="url" style="text-decoration:none;">www.sewamobilsingapore.com</a></p>
      	<p style="position:relative; bottom:80px; right:60px; font-size:0.8em; float:right;">
      	DATE : March 4, 2024 <br>
      	DUE DATE : March 11, 2024 <br>
      	AMOUNT DUE : IDR 952,000
      	</p>
      </tr><br>
      
      <tr>
      	<td>
      		<p style="position:relative; font-size:0.8em; float:left;">
      			<b>TO :</b><br>
      			Mr/Mrs, Luluk <br>
      			Indonesia <br>
      			Phone : +62 811-9592-013
      		</p>
      		<p style="position:relative; font-size:0.8em; float:right; right:60px;" >
      			<b>FROM :</b><br>
      			Mr. Efaidal / Omfai STS <br>
      			Indonesia <br>
      			Phone : +62 821-7277-4251
      		</p>
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
  			<tr class="ktk">
	  			<td class="ktk2">07/02/2024</td>
	  			<td class="ktk2">1</td>
	  			<td class="ktk2">Alphard</td>
	  			<td class="ktk2">1</td>
	  			<td class="ktk2">952,000</td>
	  			<td class="ktk2">952,000</td>
  			</tr>
  			<tr>
  				<td class="ktks"></td>
  				<td class="ktks"></td>
  				<td class="ktks"></td>
  				<td class="ktks"></td>
	  			<td class="ktks">TOTAL</td>
	  			<td class="ktk3">952,000</td>
  			</tr>
  	</table>
  	<table style="width:100%; padding:40px;">
  		<tr>
  			<td>
  				<p style="font-size:0.8em; position:relative; float:left;">Payment transfer bank account Mandiri 1090020808275 Omfai Jaya Mulya Wisata Using IDR<br>currency. Payment is due within 7 days. If you Hve any question concerning this invoice, contact<br>OMFAITRAVEL +62 821-7277-4251 
  					<br><br>
  					Thank you for your bussiness!
  				</p><br><br><br><br>
  				<p style="font-size:0.8em; position:relative; float:right; right:20px;">
  				Hormat Kami<br>
  				<img src="cap.png" border:1px solid black; width:100px; height:100px;>
  				<br>Dian dwi Martha
  				</p>
  			</td>
  		</tr>
  	</table>
  </body>
</html>';
// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'potrait');
// Setup img
	$dompdf->set_option('isRemoteEnabled',true);
// Render the HTML as PDF
	$dompdf->render();

// Output the generated PDF to Browser
	$dompdf->stream();

?>
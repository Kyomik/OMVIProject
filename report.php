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
	  font-family: SourceSansPro;
	  src: url(SourceSansPro-Regular.ttf);

	}
	*{
	  margin:0px;
	  padding:0px;
	}

	.logo{
		float: left;
		border:1px solid green;
	}

	.text{
		border:1px solid blue;
		float: right;
		position:relative;
		right:300px;
		top:25px;
	}

	.text > h5{
		font-weight: bold;
		font-size: 1em;
	}
    </style>
  </head>
  <body>
    <table style="width:100%; padding: 25px;">
      <tr>
        <td>
        	<div class="logo">
           		<img src="travelnew.png" style="width:100px; height:100px;">
           	</div>
        	<div class="text">
        		<h5>SINGAPORE <br>TRANSPORTATION <br>SERVICE</h5>
        	</div>
        </td>
        <td>
            <p style="position: relative; bottom: 75px; right:100px; text-align: center; font-size:1em; font-weight: bold;">INVOICE</p>
        </td>
      </tr>

      <tr>
        <td style="border:1px solid darkreda;">
        	<p style="font-size:0.8em; position:relative; float:left;">Marbella 2 Residences Batam, Blk F15 No 10. Belian 29431 <br>The Metropolis Tower 2. 11 North Buona Vista Drive Unit #08-09 <br>Singapore 138589</p>
        	<p style="font-size:0.8em; position:relative; float:right;">OMFAI - 24 - 001</p>
        </td>
      </tr>

      <tr>
      </tr>

      <tr>
      </tr>

      <tr>
      </tr>

      <tr>
      </tr>

      <tr>
      </tr>
    </table>
  </body>
</html>';
// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
	$dompdf->render();

// Output the generated PDF to Browser
	$dompdf->stream();
?>
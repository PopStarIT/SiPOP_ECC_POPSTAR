<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>Belajar Form PHP</title>
</head>
<body>
   <h2>Tutorial Belajar Form HTML - PHP </h2>
   <?php
   echo $pesan;
   ?>
   <form action="proses.php" method="get">
      Nama: <input type="text" name="nama" />
      <br />
      E-Mail: <input type="text" name="email" />
      <br />
      <input type="submit" value="Proses Data" >
   </form>
   
   <div id="cobaCetak">
            <p>Hello World2</p>
			 <input type="text" id="form_<?php echo $methodid ?>_idabsen" name="idabsen" class="form-control">
          </div>
</body>
</html>


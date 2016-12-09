<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="js/jquery-3.1.0.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.html">PICR - Processos Seletivos</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.html">Visualizar dados</a></li>
      <li><a href="inserir.html">Inserir Tabela</a></li>
      <li><a href="modelo.html">Modelo de Tabela</a></li>
      <li><a href="sobre.html">Sobre</a></li>
    </ul>
  </div>
</nav>

        <?php
        
        //Configurações do BD
        
        $servername = "localhost";
        $username = "root";
        $password = "007281293";
        $dbnome = "processos_seletivos";
        /*
        CREATE TABLE processos_seletivos.cursos (
          campus INT NOT NULL,
	  entrada INT NOT NULL,
          ano INT NOT NULL,
          modalidade VARCHAR(50) NOT NULL,
          curso_id INT NOT NULL,
          turno VARCHAR(50) NOT NULL,
          curso VARCHAR(50) NOT NULL,
          cotappimenor INT NOT NULL,
          cotaoutrasmenor INT NOT NULL,
          cotappimaior INT NOT NULL,
          cotaoutrasmaior INT NOT NULL,
          cotistanao INT NOT NULL,
          total_inscritos INT NOT NULL,
          total_vagas INT NOT NULL,
          razao VARCHAR(10) NOT NULL,
          PRIMARY KEY (curso_id));
        
         */
 
          $tabela_ps = "processos_seletivos";
          
          $conn = new mysqli($servername, $username, $password, $dbnome);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "Bem vindo.</br>";
        }
        
        if (isset($_POST['submit_ps'])) {
            cargaDosDados($conn,$tabela_ps);
        }
        
        function cargaDosDados($conn, $tabela) {
            $inseridos = 0;
            
            $fname = $_FILES['sel_file']['name'];
            $chk_ext = explode(".", $fname);
            if (strtolower(end($chk_ext)) == "csv") {
                $filename = $_FILES['sel_file']['tmp_name'];
                $csv = fopen($filename, "r");
                while (($valores = fgetcsv($csv, 250, ";")) !== FALSE) {
                    $sql = "INSERT INTO $tabela(campus,entrada,ano,modalidade,curso_id,turno,curso,cotappimenor,cotaoutrasmenor,cotappimaior,cotaoutrasmaior,cotistanao,total_inscritos,total_vagas,razao) VALUES ('$valores[0]','$valores[1]','$valores[2]','$valores[3]','$valores[4]','$valores[5]','$valores[6]','$valores[7]','$valores[8]','$valores[9]','$valores[10]','$valores[11]','$valores[12]','$valores[13]','$valores[14]')";
                    $conn->query($sql);
                    $inseridos++;
                }
                fclose($csv);
            }
        }
        
        
        
        
          
         ?> 
        
            <div class="col-md-3">
            <form class="" role="form" method='post' enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label" for="exampleInputPassword1">Arquivo dos Processos Seletivos</label>
                    <input type="file" size="20" name='sel_file' class="form-control">
                </div>                
                <button type="submit" name="submit_ps" class="btn btn-success">Enviar</button>
            </form>               
        </div>
        
    </body>
</html>

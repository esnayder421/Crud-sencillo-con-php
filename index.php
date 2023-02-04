
<?php
require_once 'conexion.php';
//CONSULTAR POR ID 

     // PRIMERO EL VA A BUSCAR EL REGISTRO ------
     if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql ="SELECT * FROM `producto` WHERE id=$id";
            
            $datos = $con->query($sql);
            $campo=$datos->fetch_object();
            $nombre=$campo->nombre;
            $precio=$campo->precio;
            $activo=$campo->activo;
     }

//-------GUARDA LA INFORMACION-------- -------------------------------------------------------------------------------

if(isset($_POST['accion'])){

// VERIFICAR FOTO 
$target_dir = "foto/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$nombrefoto="sinfoto.jpg";
// verifica si ya hay otra foto con ese nombre
if (file_exists($target_file)) {
  $uploadOk = true;
}

// verificar tamaño de la foto
/*
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "la foto es muy pesada";
  $uploadOk = 0;
}*/

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = false;
}
//subir o no la foto
if ($uploadOk == false) {
  echo "no se subio la foto.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    $nombrefoto=$_FILES["foto"]["name"];
  }
}


// FIN VERIFICAR FOTO1 



// INICIO VERIFICAR FOTO2
$target_dir = "foto2/";
$target_file = $target_dir . basename($_FILES["foto2"]["name"]);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$nombrefoto2="sinfoto.jpg";

// verifica si ya hay otra foto con ese nombre
if (file_exists($target_file)) {
  $uploadOk = true;
}

// verificar tamaño de la foto2
/*
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "la foto es muy pesada";
  $uploadOk = 0;
}*/

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = false;
}
//subir o no la foto2
if ($uploadOk == false) {
  echo "no se subio la foto2.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["foto2"]["tmp_name"], $target_file)) {
    $nombrefoto2=$_FILES["foto2"]["name"];
  }
}


// FIN VERIFICAR FOTO2




// VERIFICAR ARCHIVOS PDF
$target_dir = "ficha/";
$target_file = $target_dir . basename($_FILES["ficha"]["name"]);
$uploadOk = true;
$pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$nombrepdf="";
// verifica si ya hay otra foto con ese nombre
if (file_exists($target_file)) {
  //echo "ya existe ese PDF";
  $uploadOk = true;
}

// verificar tamaño de la foto
/*
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "la foto es muy pesada";
  $uploadOk = 0;
}*/

// VERIFICAR LOS ARCHIVOS PDF
if($pdfFileType != "PDF" && $pdfFileType != "pdf") {
echo "debe subir un documento PDF";
$uploadOk = false;
}
//subir o no la foto
if ($uploadOk == false) {
  echo "no se subio la ficha.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["ficha"]["tmp_name"], $target_file)) {
    $nombrepdf=$_FILES["ficha"]["name"];
  }
}


// FIN VERIFICAR ARCHIVO PDF 




    if($_POST['accion']=="GUARDAR"){
            $nombre =$_POST['nombre'];
            $precio =$_POST['precio'];
            $activo=0;
            if(isset ($_POST['activo'])){
                $activo=1;
            }
            $sql ="INSERT INTO `producto`(`id`, `nombre`, `precio`, `activo`,Foto, Foto2, ficha) 
            VALUES (default,'$nombre ','$precio','$activo','$nombrefoto','$nombrefoto2','$nombrepdf')";
            $datos = $con->query($sql);

            
    }else if($_POST['accion']=="GUARDAR CAMBIOS"){
        // PRIMERO EL VA A BUSCAR EL REGISTRO ------
        $id =$_POST['id'];
        $nombre =$_POST['nombre'];
        $precio =$_POST['precio'];
        $activo=0;
        if(isset ($_POST['activo'])){
            $activo=1;
        }
        $nombrefoto = $_POST['foto'];
        $nombrefoto2 = $_POST['foto2'];
        $nombrepdf = $_POST['ficha'];
        
        $sql ="UPDATE `producto` 
        SET `nombre`='$nombre',`precio`='$precio',`activo`='$activo',`Foto`='$nombrefoto',`Foto2`='$nombrefoto2',`ficha`='$nombrepdf'
        WHERE id=$id";
        $datos = $con->query($sql);
        header("location:index.php");
//----------------------------------------------------------------------------------------------------------------------------------------------
       
    }
 
}

//-------LISTA LA INFORMACION-------- ---------------------------------------------------------
$sql ="SELECT * FROM `producto`";
$datos = $con->query($sql);

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Gestion de Productos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
      <div class="container">
          <div class="card">
              <img class="card-img-top" src="holder.js/100x180/" alt="">
              <div class="card-body">
                  <h4 class="card-title">Registrar Producto: </h4>
                  <!-- ------------------------------------------------------FORMULARIOOO ---------------------------------------------------------->
                  <form action="" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                        <div class="row">
                            <div class="mb-3">
                              <label for="" class="form-label">Nombre:</label>
                              <input type="text" class="form-control" name="nombre" value="<?php echo @$nombre;?>" aria-describedby="helpId" placeholder="">
                              
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Precio:</label>
                              <input type="number" class="form-control" name="precio" value="<?php echo @$precio;?>"aria-describedby="helpId" placeholder="">
                              
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Activo?</label>
                              <input type="checkbox" <?php echo (@$activo==1)?"checked":"";?> name="activo" id="" aria-describedby="helpId" placeholder=""> <br>
                              <label for="" class="form-label">Primera Foto (opcional)</label> <br>
                              <input type="file" name="foto" value="<?php echo $nombreFoto;?>"><br>

                              <label for="" class="form-label">Segunda foto (opcional)</label> <br>
                              <input type="file" name="foto2" value="<?php echo @$nombrefoto2;?>"><br>
                              
                              <label for="" class="form-label">Ficha tecnica (opcional)</label> <br>
                              <input type="file" name="ficha" value="<?php echo @$nombrepdf;?>"><br>
                            </div>
                            </div>
                            <div class="mb-3">
                                <?php
                                if(isset($_GET['id'])){
                                    ?>
                                    <input type="submit" class="btn btn-success" name="accion" value="GUARDAR CAMBIOS" >
                                    <?php
                                }else{
                                    ?>
                                    <input type="submit" class="btn btn-success" name="accion" value="GUARDAR" >
                                    <?php
                                }
                                ?>
                              
                              <input type="reset" class="btn btn-info" name="accion" value="LIMPIAR" >
                            </div>
                        </div>
                 </form> 
                <!-- ------------------------------------------------------ ---------------------------------------------------------->
              </div>
          </div>
           <table class="table">
              <thead>
                  <tr>
                      <th>foto</th>
                      <th>foto 2</th>
                      <th>ID</th>
                      <th>MOBRE</th>
                      <th>PRECIO</th>
                      <th>ESTADO</th>
                      <th>FICHA</th>
                      <th>ACCIONES</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                    while($campo=$datos->fetch_object()){
                      
                      ?> <!-- se parte el php  empieza el codigo dinamico -->
                        <tr>
                          <td scope="row">
                            <!-- aqui se pone la foto por defecto si no sube foto -->
                          <?php if ($campo->Foto=="sinfoto.jpg"){?>
                            <a title="no disponible" href="">
                            <img src="foto/<?php echo $campo->Foto;?>" width="100px">
                            </a>
                            <?php }else{?>
                                <!-- abrir la imagen en una pestaña en blanco -->
                            <a title="Clic para ver imagen" href="foto/<?php echo $campo->Foto;?>" target="_blank" >
                            <img src="foto/<?php echo $campo->Foto;?>" width="100px">
                            </a>
                            <?php }?>
                          </td>
                          <!-- imagen 2 ------------ -->
                          <td scope="row">
                            <img src="foto2/<?php echo $campo->Foto2;?>" width="100px">
                          
                          </td>
                        <!-- poner los datos de la base de datos en la tabla -->
                        <td scope="row"> <?php echo $campo->id;?> </td>
                      <td><?php echo $campo->nombre;?></td>
                      <td>$<?php echo number_format($campo->precio,0,",",".");?></td>
                      <td><?php echo ($campo->activo==1?"Activo":"Inactivo");?></td>
                        <td>
                          <!-------------------------PDF--------------------- -->
                        <?php if ($campo->ficha==""){?>
                            <button type="Button" disabled class="btn btn-warning" href="">
                            Ver/descargar
                            </a>
                            <?php }else{?>
                              <a class="btn btn-info" target="_blank" href="ficha/<?php echo $campo->ficha;?>">
                                  Ver/descargar
                                  </a>
                                  <a class="btn btn-danger" href="quitar_ficha.php?id=<?php echo ($campo->id);?>&ficha=<?php echo $campo->ficha;?>">
                                  Quitar/Ficha
                                  </a>
                              <?php }?>
                        </td>
                      <td>
                      <a href="?id=<?php echo $campo->id;?>" class="btn btn-info">Editar</a>
                          <a href="eliminar.php?id=<?php echo base64_encode($campo->id);?>" class="btn btn-danger">Eliminar</a> 
                          <button class="btn btn-warning">Cambiar Estado</button> 
                       </td>
                       
                  </tr>

                    <?php
                    }
                ?>
                  
              </tbody>
          </table>
          

      </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
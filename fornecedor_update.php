<?php

@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_fornecedor'])) {

   $fornecedor_nome = $_POST['fornecedor_nome'];
   $fornecedor_cnpj = $_POST['fornecedor_cnpj'];
   $fornecedor_especialidade = $_POST['fornecedor_especialidade'];


   if (empty($fornecedor_nome) || empty($fornecedor_cnpj) || empty($fornecedor_especialidade)) {
      $message[] = 'PREENCHA TODOS OS CAMPOS!';
   } else {

      $update_data = "UPDATE fornecedores SET nome='$fornecedor_nome', cnpj='$fornecedor_cnpj', especialidade='$fornecedor_especialidade'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if ($upload) {

         header('location:fornecedor_add.php');
      } else {
         $$message[] = 'PREENCHA TODOS OS CAMPOS!';
      }
   }
};

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '<span class="message">' . $message . '</span>';
      }
   }
   ?>

   <div class="container">


      <div class="admin-fornecedor-form-container centered">

         <?php

         $select = mysqli_query($conn, "SELECT * FROM fornecedores WHERE id = '$id'");
         while ($row = mysqli_fetch_assoc($select)) {

         ?>

            <form action="" method="post" enctype="multipart/form-data">
               <h3 class="title">EDITAR FORNECEDOR</h3>
               <input type="text" class="box" name="fornecedor_nome" value="<?php echo $row['nome']; ?>" placeholder="Fornecedor">
               <input 
               type="number" 
               id="fornecedor_cnpj" 
               min="11111111111111" 
               max="99999999999999" 
               placeholder="Cnpj" 
               name="fornecedor_cnpj" 
               class="box" 
               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
               maxlength="14">
               <select type="text" name="fornecedor_especialidade" class="box" value="<?php echo $row['especialidade']; ?>">
                  <option>Comércio</option>
                  <option>Serviço</option>
                  <option>Industria</option>
               </select>
               <input type="submit" value="Editar" name="update_fornecedor" class="btn-edit">
               <a href="fornecedor_add.php" class="btn">Voltar!</a>
            </form>


         <?php }; ?>

      </div>

   </div>

</body>

</html>
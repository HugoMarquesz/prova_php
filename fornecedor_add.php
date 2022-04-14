<?php

@include 'config.php';

if (isset($_POST['add_fornecedor'])) {

   $fornecedor_nome = $_POST['fornecedor_nome'];
   $fornecedor_cnpj = $_POST['fornecedor_cnpj'];
   $fornecedor_especialidade = $_POST['fornecedor_especialidade'];

   if (empty($fornecedor_nome) || empty($fornecedor_cnpj) || empty($fornecedor_especialidade)) {
      $message[] = 'PREENCHA TODOS OS CAMPOS';
   } else {
      $insert = "INSERT INTO fornecedores(nome, cnpj, especialidade ) VALUES('$fornecedor_nome', '$fornecedor_cnpj', '$fornecedor_especialidade')";
      $upload = mysqli_query($conn, $insert);
      if ($upload) {
         $message[] = 'Fornecedor adicionado';
      } else {
         $message[] = 'Fornecedor não adicionado';
      }
   }
};

if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM fornecedores WHERE id = $id");
   header('location:fornecedor_add.php');
};

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fornecedores</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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

      <div class="admin-fornecedor-form-container">

         <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>ADICIONE UM FORNECEDOR</h3>
            <input maxlength="100" type="text" placeholder="Nome do fornecedor..." name="fornecedor_nome" class="box">
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
            <select type="text" name="fornecedor_especialidade" class="box">
               <option>Comércio</option>
               <option>Serviço</option>
               <option>Industria</option>
            </select>
            <input type="submit" class="btn" name="add_fornecedor" value="Adicionar">
         </form>

      </div>

      <?php

      $select = mysqli_query($conn, "SELECT * FROM fornecedores");

      ?>

      <div class="fornecedor-display">
         <table class="fornecedor-display-table">
            <thead>
               <tr>
                  <th>FORNECEDOR</th>
                  <th>CNPJ</th>
                  <th>ESPECIALIDADE</th>
                  <th>action</th>
               </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
               <tr>
                  <td><?php echo $row['nome']; ?></td>
                  <td><?php echo $row['cnpj']; ?></td>
                  <td><?php echo $row['especialidade']; ?></td>
                  <td>
                     <a href="fornecedor_update.php?edit=<?php echo $row['id']; ?>" class="btn-edit"> <i class="fas fa-edit"></i> edit </a>
                     <a href="fornecedor_add.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                  </td>
               </tr>
            <?php } ?>
         </table>
      </div>

   </div>


</body>

</html>
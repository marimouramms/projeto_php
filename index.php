<?php require 'home.php' ?>  


    <div class="container">
    <h3>Formulário de cadastro de funcionários</h3>
    <form method="post" action="conexao.php"> 

      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" id="nome" aria-describedby="">
      </div>

      <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="phone" name="telefone"  class="form-control" id="telefone">
      </div>

      <div class="mb-3">
        <label for="endereco" class="form-label">Endereço</label>
        <input type="text" name="endereco"  class="form-control" id="endereco">
      </div>

      <div class="mb-3">
      <label for="sexo" class="form-label">Sexo</label>
      <select class="form-select" name="sexo" id="sexo" aria-label="Default select example">
      <option selected>Selecione uma opção</option>
      <option value="masculino">Masculino</option>
      <option value="femenino">Femenino</option>
      <option value="outros">Outros</option>
      </select>      
      </div>
     
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    </div>


  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>
<?php require 'home.php' ?>  


    <div class="container">
    <h3>Formulário de cadastro de Produtos</h3>
    <form method="post" action="conexao.php"> 

      <div class="mb-3">
        <label for="nome" class="form-label">Nome do Produto</label>
        <input type="text" name="nome" class="form-control" id="nome" aria-describedby="">
      </div>

      <div class="mb-3">
        <label for="telefone" class="form-label">Quantidade</label>
        <input type="number" name="quantidade"  class="form-control" id="quantidade">
      </div>

      <div class="mb-3">
        <label for="telefone" class="form-label">Valor</label>
        <input type="number" name="valor"  class="form-control" id="valor">
      </div>

      <div class="mb-3">
        <label for="endereco" class="form-label">Desrição</label>
        <input type="text" name="descricao"  class="form-control" id="descricao">
      </div>

    
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    </div>


  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>
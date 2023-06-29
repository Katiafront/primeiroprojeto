<?php 
$pag = 'categorias';
@session_start();
require_once('../conexao.php');

?>


<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" class="btn btn-secondary mt-2" id="novo">Nova Categoria</a>

<!-- DATATABLES -->
<div class="mt-4" style="margin-rigth:25px">

	<!-- Select nos registros do banco de dados -->
	<?php 
	$query_con = $pdo->query("SELECT * from categorias order by id desc");
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($result);
	if ($total_reg > 0) { ?>

		<small>
		
		<!-- If aberto para mostrar a tabela -->		
		<table id="tabela-registros" class="table table-hover" style="width:100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Produtos</th>
					<th>Foto</th>
					<th>Ações</th>
					
				</tr>
			</thead>
			<tbody>
				<!-- Preenchendo a tabela com registro através do for -->
				<?php 
				for($i=0; $i < $total_reg; $i++){
					foreach ($result[$i] as $key => $value)
					{}
// for aberto para renderizar registro na tabela
				?>
				<tr>
					<td><?php echo $result[$i]['nome'] ?></td>
					<td><?php echo $result[$i]['produtos'] ?></td>
					<td><img src="../img/categorias/<?php echo $result[$i]['foto'] ?>" width="50"></td>
					</td>
					<td>
						<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $result[$i]['id'] ?>" title="Editar registro"><i class="bi bi-pencil-square text-primary"></i></a>
						<a href="index.php?pagina=<?php echo $pag ?>&funcao=excluir&id=<?php echo $result[$i]['id'] ?>" title="Excluir registro"><i class="bi bi-archive text-danger mx-2"></i></a>


					</td>
				</tr>
				<!-- Fechamento do bloco for -->
			<?php } ?>
		</tbody>
	</table>

</small>

	<!-- Se não existir registro no banco de dados -->
	<!-- Fecho o if e adiciono o else -->
<?php } else{
	echo '<p> Nenhum registro encontrado. </p>';
}?>
</div>

<!-- Titulo da modal Cadastrar ou Editar -->
<?php 
if (@$_GET['funcao'] == 'editar') {
	$titulo_modal = 'Editar Registro';
	// Recuperando dados do registro para o formulário da modal abaixo
	$query_con = $pdo->query("SELECT * from categorias where id = $_GET[id]");
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($result);
	if ($total_reg > 0) {
		$nome = $result[0]['nome'];
		$foto = $result[0]['foto'];
		
	} 
} else {
	$titulo_modal = 'Inserir Registro';
}

?>

<!-- Model para inserir novo registro --> 

<div class="modal fade" id="modalCadastrar" tabindex="-1"  data-bs-backdrop="static"> 
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $titulo_modal ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form method="POST" id="form">
				<div class="modal-body">

			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" class="form-control form-control-sm" name="nome" id="nome" placeholder="Nome" required="" value="<?php echo @$nome ?>">
			</div>

			
			<div class="form-group">
				<label >Foto</label>
				<input type="file" value="<?php echo @$foto ?>"  class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
			</div>

			<div id="divImgConta" class="mt-4">
				<?php if(@$foto != ""){ ?>
					<img src="../img/categorias/<?php echo $foto ?>"  width="200px" id="target">
				<?php  }else{ ?>
					<img src="../img/categorias/sem-foto.jpg" width="200px" id="target">
				<?php } ?>
			</div>

			<small><div align="center" id="mensagem">

			</div></small>
		</div>



				<!-- <button type="submit" class="btn btn-primary">Enviar</button> -->

			
			<div class="modal-footer">
				<button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

				<input name="id"type="hidden" value="<?php echo @$_GET['id'] ?>">
				<input type="hidden" name="antigo" value="<?php echo @$nome ?>">

			</div>
		</form>
	</div>
</div>
</div>



			<!-- Modal para excluir registro -->

			<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Excluir Registro</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" id="form-excluir">
								<p>Deseja realmente excluir o registro? </p>

								<small><div align="center" id="mensagem-excluir">

								</div></small>

								<!-- <button type="submit" class="btn btn-primary">Enviar</button> -->

							</div>
							<div class="modal-footer">
								<button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button id="btn-excluir" type="submit" class="btn btn-danger">Excluir</button>

								<input type="hidden" name="id" value="<?php echo @$_GET['id'] ?>">

								<input type="hidden" name="antigo" value="<?php echo @$nome ?>">

							</div>
						</form>
					</div>
				</div>
			</div>


			<!-- Função PHP que chama a modal para cadastrar -->
			<?php 
			if (@$_GET['funcao'] == 'novo') {?>
				<script type="text/javascript">
					$('#modalCadastrar').modal('show')
				</script>
			<?php } ?>

			<!-- Função PHP que chama a modal para editar o registro -->
			<?php 
			if (@$_GET['funcao'] == 'editar') {?>
				<script type="text/javascript">
					$('#modalCadastrar').modal('show')
				</script>
			<?php } ?>

			<!-- Função PHP que chama a modal para excluir registro -->
			<?php 
			if (@$_GET['funcao'] == 'excluir') {?>
				<script type="text/javascript">
					$('#modalExcluir').modal('show')
				</script>
			<?php } ?>

			<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
			<script type="text/javascript">
				$("#form").submit(function () {
					var pag = "<?=$pag?>";
					event.preventDefault();
					var formData = new FormData(this);

					$.ajax({
						url: pag + "/inserir.php",
						type: 'POST',
						data: formData,

						success: function (mensagem) {

							$('#mensagem').removeClass()

							if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
								$('#btn-fechar').click();
								window.location = "index.php?pagina="+pag;

							} else {

								$('#mensagem').addClass('text-danger')
							}

							$('#mensagem').text(mensagem)

						},

						cache: false,
						contentType: false,
						processData: false,
            xhr: function () {  // Custom XMLHttpRequest
            	var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                	myXhr.upload.addEventListener('progress', function () {
                		/* faz alguma coisa durante o progresso do upload */
                	}, false);
                }
                return myXhr;
            }
        });
				});
			</script>

			<!--AJAX PARA EXCLUSÃO DE  DADOS COM IMAGEM -->
			<script type="text/javascript">
				$("#form-excluir").submit(function () {
					var pag = "<?=$pag?>";
					event.preventDefault();
					var formData = new FormData(this);

					$.ajax({
						url: pag + "/excluir.php",
						type: 'POST',
						data: formData,

						success: function (mensagem) {

							$('#mensagem').removeClass()

							if (mensagem.trim() == "Excluído com Sucesso!") {


								$('#btn-fechar').click();
								window.location = "index.php?pagina="+pag;

							} else {

								$('#mensagem-excluir').addClass('text-danger')
							}

							$('#mensagem-excluir').text(mensagem)

						},

						cache: false,
						contentType: false,
						processData: false,

					});
				});
			</script>


			<script>
				$(document).ready(function() {
					$('#tabela-registros').DataTable({
						ordering: false
					});
				} );
			</script>





<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">

    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }

</script>












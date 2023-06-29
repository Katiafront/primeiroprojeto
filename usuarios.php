<?php 
require_once('../conexao.php');
$pag = 'usuarios';
?>


<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" class="btn btn-secondary mt-2" id="novo">Novo Usuário</a>

<!-- DATATABLES -->
<div class="mt-3">

	<!-- Select nos registros do banco de dados -->
	<?php 
	$query_con = $pdo->query("SELECT * from usuarios order by id desc");
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($result);
	if ($total_reg > 0) { ?>
		
<!-- If aberto para mostrar a tabela -->		
		<table id="tabela-registros" class="table table-hover" style="width:100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>CPF</th>
					<th>Email</th>
					<th>Nivel</th>
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
					<td><?php echo $result[$i]['cpf'] ?></td>
					<td><?php echo $result[$i]['email'] ?></td>
					<td><?php echo $result[$i]['nivel'] ?></td>
					<td>
						<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $result[$i]['id'] ?>" title="Editar registro"><i class="bi bi-pencil-square text-primary"></i></a>
						<a href="index.php?pagina=<?php echo $pag ?>&funcao=excluir&id=<?php echo $result[$i]['id'] ?>" title="Excluir registro"><i class="bi bi-archive text-danger mx-2"></i></a>


					</td>
				</tr>
				<!-- Fechamento do bloco for -->
			<?php } ?>
		</tbody>
	</table>

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
	$query_con = $pdo->query("SELECT * from usuarios where id = $_GET[id]");
	$result = $query_con->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($result);
	if ($total_reg > 0) {
		$nome = $result[0]['nome'];
		$email = $result[0]['email'];
		$cpf = $result[0]['cpf'];
		$senha = $result[0]['senha'];
		$nivel = $result[0]['nivel'];
	} 
} else {
	$titulo_modal = 'Inserir Registro';
}

?>

<!-- Model para inserir novo registro --> 

<div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $titulo_modal ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="form">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" class="form-control form-control-sm" name="nome" id="nome" placeholder="Nome" required="" value="<?php echo @$nome ?>">
					</div>

					<div class="form-group">
						<label for="nome">E-mail</label>
						<input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Email" required="" value="<?php echo @$email ?>">
					</div>

					<div class="form-group">
						<label for="cpf">CPF</label>
						<input type="text" class="form-control form-control-sm" name="cpf" id="cpf" placeholder="CPF" required="" value="<?php echo @$cpf ?>">
					</div>

					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" class="form-control form-control-sm" name="senha" id="senha" placeholder="Senha" required="" value="<?php echo @$senha ?>">
					</div>

					<div class="form-group">
						<label for="nivel">Nível</label>
						<select class="form-control form-control-sm" name="nivel" id="nivel" required="">
							<option 
							<?php if (@$nivel_edit == 'Administrador') {
								?> selected
								<?php } ?> value="Administrador">Administrador
							</option>

							<option <?php if (@$nivel == 'Operador') {
								?> selected
								<?php } ?> value="Operador">Operador</option>

								<option <?php if (@$nivel == 'Tesoureiro') {
									?> selected
									<?php } ?> value="Tesoureiro">Tesoureiro</option>
								</select>
							</div>

							<small><div align="center" id="mensagem">

							</div></small>

							<!-- <button type="submit" class="btn btn-primary">Enviar</button> -->

						</div>
						<div class="modal-footer">
							<button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
							<button id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

							<input type="hidden" name="id" value="<?php echo @$_GET['id'] ?>">

							<input type="hidden" name="antigo_email" value="<?php echo @$email ?>">
							<input type="hidden" name="antigo_cpf" value="<?php echo @$cpf ?>">

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
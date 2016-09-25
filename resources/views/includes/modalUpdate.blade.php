<div class="modal fade" id="modalUpd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Alterar Link</h4>
			</div>
			<div class="modal-body">

				<form action="" method="POST" class="updateFile">
					{{ method_field('PUT') }}
					{{ csrf_field() }}
					<div class="form-group">
						<label for="url" >Url:</label>
						<input type="url" name="url_up" required class="form-control" id="url_up" placeholder="Insira sua Url">
						<input type='hidden' id='file_id' name="file_id">
					</div>
					<div class="form-group">
						<label for="pwd">Grupo:</label>
						<div class="input-group" >
							<input type="text" class="form-control" required name="group_up" id="group_up" aria-label="..." placeholder="Crie um grupo ou use um existente">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Grupos <span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right azul">
									@forelse($groups as $group)
									    <li>
									    	<a onclick='getDropdownUp(this.innerHTML)' href='javascript:;'>{{$group->group}}</a>
									    </li>
									@empty
										<p>Cadastre um grupo</p>
									@endforelse	
								</ul>
							</div><!-- /btn-group -->
						</div><!-- /input-group -->
					</div>
					<div class="form-group">
						<label for="pwd">Comentarios:</label>
						<textarea style="resize: none;"  required  maxlength="61" name="comments_up" class="form-control" id="comments_up" placeholder="Comente..."></textarea>
					</div>
					<div class="form-group">
						<label for="private">Privado:</label>
						<input type="checkbox" name="priv_up" id="priv_up" >
					</div>
					<br />
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Cancelar
						</button>
						<button type="submit" class="btn btn-primary">
							Salvar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

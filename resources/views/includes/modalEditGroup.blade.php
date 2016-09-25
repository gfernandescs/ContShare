<!-- Start Modal Update Group -->
<div class="modal fade" id="modalConfig" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Alterar Grupo</h4>
		    </div>
		    <div class="modal-body">
		        <form action="" class="updateGroup" method="post">
		        	{{ method_field('PUT') }}
					{{ csrf_field() }}
					  <div class="form-group">
					  	<label for="private">Título:</label>
						<input type="text" name="title" required class="form-control" id="titulo" placeholder="Novo Título para o grupo">
						<input type='hidden' id='old_title' name="old_title" value="{{$group}}">
					  </div>
					  
					  <br />
					  <div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        		<button type="submit" class="btn btn-primary">Salvar</button>
		      		  </div>
				</form>
		    </div>
		</div>
	 </div>
</div>
<!--End Modal -->
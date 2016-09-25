<div class="modal fade" id="modalCopy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 <div class="modal-dialog" role="document">
		 <div class="modal-content">
		     <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Copiar Link</h4>
		      </div>
		      <div class="modal-body">
		        <form action="#" class="saveFile" method="post">
		       		{{ csrf_field() }}
		       		<input name="route" type="hidden" value="{{route('files.store')}}"/>
			    	<div class="form-group">
						<input type="hidden" name="url" required class="form-control" id="url" placeholder="Insira sua Url">
						<input type='hidden' id='txcode' name="codfile">
					</div>
					<div class="form-group">
					    <label for="pwd">Grupo:</label>
						<div class="input-group" >
							<input type="text" class="form-control" required name="group_s" id="group_s" aria-label="..." placeholder="Crie um grupo ou use um existente">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Grupos <span class="caret"></span></button>
							    <ul class="dropdown-menu dropdown-menu-right azul">	
							    	@if(Auth::check())		    
										@forelse($groups_modal as $group)
										    <li>
										    	<a onclick='getDropdown(this.innerHTML)' href='javascript:;'>{{$group->group}}</a>
										    </li>
										@empty
											<p>Cadastre um grupo</p>
										@endforelse
									@endif	  
							    </ul>
							</div><!-- /btn-group -->
					  	</div><!-- /input-group -->
					  </div>
					  <div class="form-group">
						<label for="pwd">Comentarios:</label>
					    <textarea style="resize: none;"  required  maxlength="61" name="comments" class="form-control" id="comments" placeholder="Comente..."></textarea>
					  </div>
					  <div class="form-group">
					  	<label for="private">Privado:</label>
						<input type="checkbox" name="priv" id="priv" >
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
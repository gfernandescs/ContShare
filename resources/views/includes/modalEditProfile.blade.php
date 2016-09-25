<!-- Start Modal Edit Profile -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Editar Perfil</h4>
		    </div>
		    <div class="modal-body">
		        <form action="{{route('users.update', ['id' => auth()->user()->id])}}" method="post" enctype="multipart/form-data">
		        	{{ method_field('PUT') }}
		        	{{ csrf_field() }}
			    	<div class="form-group">
						<label for="name" >Nome:</label>
						<input type="text" name="name" required class="form-control" id="name_u" placeholder="Nome ">
					</div>
					<div class="form-group">
						<label for="name" >Sobrenome:</label>
						<input type="text" name="last_name" required class="form-control" id="last_name_u" placeholder="Sobrenome">
					</div>
					<div class="form-group">
					    <label for="pwd">Foto:</label>
						<div class="input-group" >						
							<input name="photo" type="file" id="photo_u"/>
							<input type='hidden' id='name_photo' name="name_photo">
						</div><!-- /input-group -->
					</div>
					<div class="form-group">
						<label for="pwd">Sobre Você:</label>
					    <textarea style="resize: none;"  required  maxlength="61" name="about" class="form-control" id="about_u" placeholder="Fale sobre você..."></textarea>
					</div>
					<br />
					<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        		<button type="submit" class="btn btn-primary" name="edit">Salvar</button>
		      		</div>
				</form>
		    </div>
		</div>
	</div>
</div>
<!--End Modal -->
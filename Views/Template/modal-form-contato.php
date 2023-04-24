<div id="modal-form-contato" class="modal">
          <div class="modal-content">
            <h4 id="titulo" class="center"> Novo Contato</h4>
            <hr>
            <br>
              <form action="?controle=Contato&metodo=manterContatos" method="POST">
                <div class="row">
                      <input type="hidden" id="id_con" name="id_con">
                      <div class="input-field col m12 ">
                          <input id="name" type="text" class="validate" name="nm_con" maxlength="30" placeholder="Insert the Person's name" required>
                          <label for="name">Nome Contato</label>
                      </div>
                      <div class="input-field col m12">
                          <input id="email" type="text" class="validate" name="email_con" maxlength="40" placeholder="youremail@example.com" required> 
                          <label for="email">E-mail</label>    
                      </div></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancelar</button>
            <button type="submit" id="" class="modal-close waves-effect waves-green btn-flat green white-text">Confirmar</button>
          </div>
          </form>
          
</div>
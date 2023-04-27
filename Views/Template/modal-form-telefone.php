<div id="modal-form-telefone" class="modal">
          <div class="modal-content">
            <h4 id="titulo" class="center"> Novo Telefone</h4>
            <hr>
            <br>
              <form action="?controle=telefone&metodo=manterTelefone" method="POST">
                <div class="row">
                      <input type="hidden" id="id" name="id_tel">
                      <input type="hidden" id="id" name="id_con" value="<?= $v_con->getId() ?>">
                      <div class="input-field col m3 ">
                          <input id="ddd" maxlength="3" type="text" class="validate" name="ddd_tel" placeholder="(xxx)" value='' required>
                          <label for="ddd">DDD</label>
                      </div>
                      <div class="input-field col m9 ">
                          <input id="num" maxlength="15" type="text" class="validate" name="nr_tel" placeholder="xxxx-xxxx" value=""required> 
                          <label for="num">Numero</label>    
                      </div>
                      <div class="input-field col m12">
                          <select class="browser-default" id="tp" name="tp_tel" required>
                            <option value="" selected>Selecione o Tipo do Telefone</option>
                            <option value="Fixo" >Fixo</option>
                            <option value="Celular" >Celular</option>
                            <option value="Comercial" >Comercial</option>
                          </select>
                      </div>
                </div>
          <div class="modal-footer">
            <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancelar</button>
            <button type="submit" id="" class="modal-close waves-effect waves-green btn-flat green white-text">Confirmar</button>
          </div>
          </form> 
          
</div>
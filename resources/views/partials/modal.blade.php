<!-- MODAL -->
<form id="FormDelete" action="" method="post" onsubmit="return false;">
    @csrf
</form>
<!-- USER -->
<div class="modal fade" id="ModalUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormUser" action="" method="post" onsubmit="return false;">
                @csrf
                <input name="metodo" type="hidden" />
                <input name="id" type="hidden" />
                <div class="modal-header">
                    <h5 class="modal-title">Información del usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="au-input au-input--full" type="text" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input class="au-input au-input--full" type="text" name="apellido" placeholder="Apellido">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <input class="au-input au-input--full" type="checkbox" name="estado">
                    </div>
                    <div class="form-group">
                        <label>Contrase&ntilde;a</label>
                        <input class="au-input au-input--full" type="password" name="password"
                            placeholder="Contrase&ntilde;a">
                    </div>
                    <div class="form-group">
                        <label>Confirmar Contrase&ntilde;a</label>
                        <input class="au-input au-input--full" type="password" name="confpassword"
                            placeholder="Contrase&ntilde;a">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ROL -->
<div class="modal fade" id="ModalRol" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormRol" action="" method="post" onsubmit="return false;">
                @csrf
                <input name="metodo" type="hidden" />
                <input name="id" type="hidden" />
                <div class="modal-header">
                    <h5 class="modal-title">Información del usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="au-input au-input--full" type="text" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <input class="au-input au-input--full" type="checkbox" name="estado">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- AUTOR -->
<div class="modal fade" id="ModalAutor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormAutor" action="" method="post" onsubmit="return false;">
                @csrf
                <input name="metodo" type="hidden" />
                <input name="id" type="hidden" />
                <div class="modal-header">
                    <h5 class="modal-title">Información del usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="au-input au-input--full" type="text" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- EDITORIAL -->
<div class="modal fade" id="ModalEditorial" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormEditorial" action="" method="post" onsubmit="return false;">
                @csrf
                <input name="metodo" type="hidden" />
                <input name="id" type="hidden" />
                <div class="modal-header">
                    <h5 class="modal-title">Información del usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="au-input au-input--full" type="text" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- CATEGORIA -->
<div class="modal fade" id="ModalCategoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormCategoria" action="" method="post" onsubmit="return false;">
                @csrf
                <input name="metodo" type="hidden" />
                <input name="id" type="hidden" />
                <div class="modal-header">
                    <h5 class="modal-title">Información del usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="au-input au-input--full" type="text" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL -->

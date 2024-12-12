<style>
    select {
        width: 70px;
    }
</style>
<div class="new122">
    <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="fas fa-tools"></i>
        </span>
        <h5>Equipamentos</h5>
    </div>
    <div class="span12" style="margin-left: 0">
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aEquipamento')) : ?>
            <div class="span3 flexxn" style="display: flex;">
                <a href="<?= base_url() ?>index.php/equipamentos/adicionar" class="button btn btn-mini btn-success" style="max-width: 160px">
                    <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2"> Equipamentos</span>
                </a>
            </div>
        <?php endif; ?>
        <form class="span9" method="get" action="<?= base_url() ?>index.php/equipamentos" style="display: flex; justify-content: flex-end;">
            <div class="span3">
                <input type="text" name="pesquisa" id="pesquisa" placeholder="Buscar por Nome ou Número de Série..." class="span12" value="<?= $this->input->get('pesquisa') ?>">
            </div>
            <div class="span1">
                <button class="button btn btn-mini btn-warning" style="min-width: 30px">
                    <span class="button__icon"><i class='bx bx-search-alt'></i></span>
                </button>
            </div>
        </form>
    </div>

    <div class="widget-box">
        <h5 style="padding: 3px 0"></h5>
        <div class="widget-content nopadding tab-content">
            <table id="tabela" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cod.</th>
                        <th>Número de Série</th>
                        <th>Nome</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$results) {
                        echo '<tr>
                            <td colspan="6">Nenhum Equipamento Cadastrado</td>
                          </tr>';
                    }
                    foreach ($results as $r) {
                        echo '<tr>';
                        echo '<td>' . $r->idEquipamentos . '</td>';
                        echo '<td>' . $r->numero_serie . '</td>';
                        echo '<td>' . $r->modelo . '</td>';
                        echo '<td>' . $r->idClientes . '</td>';  // Exibe o nome do cliente
                        // echo '<td class="cliente-id" data-idCliente="' . $r->idClientes . '">Carregando...</td>';
                        echo '<td>';
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vEquipamento')) {
                            echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/equipamentos/visualizar/' . $r->idEquipamentos . '" class="btn-nwe" title="Visualizar Equipamento"><i class="bx bx-show bx-xs"></i></a>';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eEquipamento')) {
                            echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/equipamentos/editar/' . $r->idEquipamentos . '" class="btn-nwe3" title="Editar Equipamento"><i class="bx bx-edit bx-xs"></i></a>';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dEquipamento')) {
                            echo '<a style="margin-right: 1%" href="#modal-excluir" role="button" data-toggle="modal" equipamento="' . $r->idEquipamentos . '" class="btn-nwe4" title="Excluir Equipamento"><i class="bx bx-trash-alt bx-xs"></i></a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php echo $this->pagination->create_links(); ?>

<!-- Modal Exclusão -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/equipamentos/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel"><i class="fas fa-trash-alt"></i> Excluir Equipamento</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idEquipamento" class="idEquipamento" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir este equipamento?</h5>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span>
            </button>
            <button class="button btn btn-danger">
                <span class="button__icon"><i class='bx bx-trash'></i></span><span class="button__text2">Excluir</span>
            </button>
        </div>
    </form>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', 'a', function(event) {
            var equipamento = $(this).attr('equipamento');
            $('.idEquipamento').val(equipamento);
        });
    });

</script>
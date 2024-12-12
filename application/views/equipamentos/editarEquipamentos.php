<?php $this->load->view('includes/header'); ?>

<div class="container">
    <h2>Editar Equipamento</h2>

    <form action="<?php echo base_url('equipamentos/atualizar/' . $equipamento->idEquipamentos); ?>" method="post">
        <div class="form-group">
            <label>Modelo</label>
            <input type="text" name="modelo" class="form-control" value="<?php echo $equipamento->modelo; ?>" required>
        </div>
        <div class="form-group">
            <label>Marca</label>
            <input type="text" name="marca" class="form-control" value="<?php echo $equipamento->marca; ?>" required>
        </div>
        <div class="form-group">
            <label>Número de Série</label>
            <input type="text" name="numero_serie" class="form-control" value="<?php echo $equipamento->numero_serie; ?>" required>
        </div>
        <div class="form-group">
            <label>Acessório Recebido</label>
            <input type="text" name="acessorioRecebido" class="form-control" value="<?php echo $equipamento->acessorioRecebido; ?>">
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <input type="text" name="tipo" class="form-control" value="<?php echo $equipamento->tipo; ?>">
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="<?php echo base_url('equipamentos'); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php $this->load->view('includes/footer'); ?>

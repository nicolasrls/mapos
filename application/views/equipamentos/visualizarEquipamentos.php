<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title" style="margin: -20px 0 0">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="fas fa-laptop"></i></span>
                    <h5>Dados do Equipamento</h5>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="text-align: center; width: 30%"><strong>Nome do Equipamento</strong></td>
                            <td>
                                <?php echo $equipamento->nome; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Marca</strong></td>
                            <td>
                                <?php echo $equipamento->marca; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Modelo</strong></td>
                            <td>
                                <?php echo $equipamento->modelo; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Serial Number</strong></td>
                            <td>
                                <?php echo $equipamento->serial_number; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Data de Aquisição</strong></td>
                            <td>
                                <?php echo date('d/m/Y', strtotime($equipamento->data_aquisicao)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Garantia</strong></td>
                            <td>
                                <?php echo $equipamento->garantia ? 'Sim' : 'Não'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Observações</strong></td>
                            <td>
                                <?php echo $equipamento->observacoes; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


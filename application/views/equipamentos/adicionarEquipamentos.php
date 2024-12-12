<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/trumbowyg/ui/trumbowyg.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/trumbowyg/trumbowyg.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/trumbowyg/langs/pt_br.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <h5>Cadastro de Equipamento</h5>
            </div>
            <div class="widget-content nopadding tab-content">
                <div class="span12" id="divEquipamento" style=" margin-left: 0">

                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes do Equipamento</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="span12" id="divCadastrarEquipamento">
                                <?php if ($custom_error == true) { ?>
                                    <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente cliente e outros dados obrigatórios.</div>
                                <?php } ?>
                                <form action="<?php echo current_url(); ?>" method="post" id="formEquipamento">
                                    <div class="span12" style="padding: 1%">
                                        <div class="span6">
                                            <label for="cliente">Cliente<span class="required">*</span></label>
                                            <input id="cliente" class="span12" type="text" name="cliente" value="" />
                                            <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="" />
                                        </div>
                                        <div class="span6">
                                            <label for="modelo">Modelo<span class="required">*</span></label>
                                            <input id="modelo" class="span12" type="text" name="modelo" value="" />
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span3">
                                            <label for="marca">Marca<span class="required">*</span></label>
                                            <input id="marca" class="span12" type="text" name="marca" value="" />
                                        </div>
                                        <div class="span3">
                                            <label for="numero_serie">Número de Série<span class="required">*</span></label>
                                            <input id="numero_serie" class="span12" type="text" name="numero_serie" value="" />
                                        </div>
                                        <div class="span3">
                                            <label for="acessorio">Acessório<span class="required">*</span></label>
                                            <select class="span12" name="acessorio" id="acessorio">
                                                <option value="Sim">Sim</option>
                                                <option value="Não" selected>Não</option>
                                            </select>
                                        </div>
                                        <div class="span3">
                                            <label for="acessoriorecebido" id="acessoriorecebido">Acessório Recebido?</label>
                                            <input type="text" name="acessoriorecebido" id="acessoriorecebido2" maxlength="20">
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span3">
                                            <label for="tipo">Tipo de Equipamento<span class="required">*</span></label>
                                            <select class="span12" name="tipo" id="tipo">
                                                <option value="Notebook">Notebook</option>
                                                <option value="Computador Gamer">Computador Gamer</option>
                                                <option value="Computador Office">Computador Office</option>
                                                <option value="Carregador">Carregador</option>
                                                <option value="Impressora">Impressora</option>
                                                <option value="Console">Console</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="display:flex">
                                            <button class="button btn btn-success" id="btnCadastrarEquipamento">
                                                <span class="button__icon"><i class='bx bx-chevrons-right'></i></span><span class="button__text2">Cadastrar</span></button>
                                            <a href="<?php echo base_url() ?>index.php/equipamentos" class="button btn btn-mini btn-warning" style="max-width: 160px">
                                                <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        toggleAcessorioRecebido();

        $("#acessorio").on("change", function() {
            toggleAcessorioRecebido();
        });

        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/financeiro/autoCompleteClienteAddReceita",
            minLength: 1,
            select: function(event, ui) {
                $("#clientes_id").val(ui.item.id);
            }
        });
        $("#marca").autocomplete({
            source: "<?php echo base_url(); ?>index.php/marcas/autoCompleteMarcas",
            minLength: 1,
            select: function(event, ui) {
                $("#marcas_id").val(ui.item.id);
            }
        });

        $("#formEquipamento").validate({
            rules: {
                cliente: {
                    required: true
                },
                modelo: {
                    required: true
                },
                marca: {
                    required: true
                },
                numero_serie: {
                    required: true
                },
                tipo: {
                    required: true
                }
            },
            messages: {
                cliente: {
                    required: 'Campo Requerido.'
                },
                modelo: {
                    required: 'Campo Requerido.'
                },
                marca: {
                    required: 'Campo Requerido.'
                },
                numero_serie: {
                    required: 'Campo Requerido.'
                },
                tipo: {
                    required: 'Campo Requerido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });

        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });
    });

    function toggleAcessorioRecebido() {
        if ($("#acessorio").val() == "Sim") {
            $("#acessoriorecebido").show();
            $("#acessoriorecebido2").show();
        } else {
            $("#acessoriorecebido").hide();
            $("#acessoriorecebido2").hide();
        }
    }
</script>
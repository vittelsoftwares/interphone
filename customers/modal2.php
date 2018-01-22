<!-- Modal de Importar-->
<div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="modalLabel"><i class="fa fa-upload"></i> Importação em massa de Moradores</h3>
            </div>
            <div class="modal-body">
                <div class="jumbotron">
                    <p>Atenção: O arquivo deve ser no formato <b>.CSV</b> e os campos do morador no arquivo deve ser separado por <b>;</b></p>
                    <p style="
    margin-bottom: 0px;
    margin-left: 0px;
    font-size: 12px;
    font-weight: 100;">Exemplo: Nome do Proprietário;Nome do Conjuge;Quadra/Lote;"EM BRANCO";"EM BRANCO";Celular do Proprietario;"EM BRANCO";"EM BRANCO";Celular do Conjuge;Telefone Fixo;"EM BRANCO";"EM BRANCO"</p>
                </div>
                <h4>Selecione o arquivo (.csv) para importar</h4>
                <form method="POST" action="processa.php" enctype="multipart/form-data">
                    <input type="file" class="btn btn-sm btn-primary" name="file"><br><br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <a id="cancel" class="btn btn-default" data-dismiss="modal">Sair</a>
                </form>
            </div>
            </div>

        </div>
    </div>
</div> <!-- /.modal -->
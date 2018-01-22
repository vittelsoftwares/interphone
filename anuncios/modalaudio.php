<!-- Modal de Importar-->
<div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="modalLabel"><i class="fa fa-upload"></i> Importar Audio para Anuncio</h3>
            </div>
            <div class="modal-body">
                <div class="jumbotron">
                    <p>Atenção: O audio deve possuir a extensão <b>.wav ou .gsm</b>, preferencialmente sem espaços no nome</p>
                    <p style="
    margin-bottom: 0px;
    margin-left: 0px;
    font-size: 14px;
    font-weight: 200;">Exemplo: audiodeanuncio.wav</p>
                </div>
                <h4>Selecione o arquivo de audio (.wav ou .gsm) para importar</h4>
                <form method="POST" action="processaaudio.php" enctype="multipart/form-data">
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
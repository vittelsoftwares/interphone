/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget);
  var id = button.data('customer');
  var nome = button.data('morador');

  var modal = $(this);
  modal.find('.modal-title').text('Excluir Morador: ' + nome);
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})

$('#delete2-modal').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget);
  var id2 = button.data('customer');
  var nome2 = button.data('morador');

  var modal = $(this);
  modal.find('.modal-title').text('Excluir Usuário: ' + nome2);
  modal.find('#confirm').attr('href', 'deleteuser.php?id=' + id2);
})
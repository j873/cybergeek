var inputsCEP = $('#logradouro, #bairro, #localidade, #uf, #ibge');
var inputsRUA = $('#cep, #bairro, #ibge');
var validacep = /^[0-9]{8}$/;

function limpa_formulário_cep(alerta) {
  if (alerta !== undefined) {
    alert(alerta);
  }

  inputsCEP.val('');
}

function get(url) {

  $.get(url, function(data) {

    if (!("erro" in data)) {

      if (Object.prototype.toString.call(data) === '[object Array]') {
        var data = data[0];
      }

      $.each(data, function(nome, info) {
        $('#' + nome).val(nome === 'cep' ? info.replace(/\D/g, '') : info).attr('info', nome === 'cep' ? info.replace(/\D/g, '') : info);
      });



    } else {
      limpa_formulário_cep("CEP não encontrado.");
    }

  });
}

// Digitando RUA/CIDADE/UF
$('#logradouro, #localidade, #uf').on('blur', function(e) {

  if ($('#logradouro').val() !== '' && $('#logradouro').val() !== $('#logradouro').attr('info') && $('#localidade').val() !== '' && $('#localidade').val() !== $('#localidade').attr('info') && $('#uf').val() !== '' && $('#uf').val() !== $('#uf').attr('info')) {

    inputsRUA.val('...');
    get('https://viacep.com.br/ws/' + $('#uf').val() + '/' + $('#localidade').val() + '/' + $('#logradouro').val() + '/json/');
  }

});

// Digitando CEP
$('#cep').on('blur', function(e) {

  var cep = $('#cep').val().replace(/\D/g, '');

  if (cep !== "" && validacep.test(cep)) {

    inputsCEP.val('...');
    get('https://viacep.com.br/ws/' + cep + '/json/');

  } else {
    limpa_formulário_cep(cep == "" ? undefined : "Formato de CEP inválido.");
  }
});
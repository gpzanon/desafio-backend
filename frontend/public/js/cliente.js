
/*
// CONSULTA CEP

function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('END_LOGRADOURO').value=("");
    document.getElementById('END_BAIRRO').value=("");
    document.getElementById('CIDADE').value=("");
    document.getElementById('ESTADO').value=("");
   // document.getElementById('codibge').value=("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById('END_LOGRADOURO').value=(conteudo.logradouro);
    document.getElementById('END_BAIRRO').value=(conteudo.bairro);
    document.getElementById('CIDADE').value=(conteudo.localidade);
    document.getElementById('ESTADO').value=(conteudo.uf);
    //document.getElementById('codibge').value=(conteudo.ibge);
    } //end if.
    else {
    //CEP não Encontrado.
    limpa_formulário_cep();
    alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');
    
    //Verifica se campo cep possui valor informado.
    if (cep != "") {
    
    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;
    
    //Valida o formato do CEP.
    if(validacep.test(cep)) {
    
    //Preenche os campos com "..." enquanto consulta webservice.
    document.getElementById('END_LOGRADOURO').value="...";
    document.getElementById('END_BAIRRO').value="...";
    document.getElementById('CIDADE').value="...";
    document.getElementById('ESTADO').value="...";
    //document.getElementById('codibge').value="...";
    
    //Cria um elemento javascript.
    var script = document.createElement('script');
    
    //Sincroniza com o callback.
    script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
    
    //Insere script no documento e carrega o conteúdo.
    document.body.appendChild(script);
    
    } //end if.
    else {
    //cep é inválido.
    limpa_formulário_cep();
    alert("Formato de CEP inválido.");
    }
    } //end if.
    else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
    }
}    

// Oculta ou mostra 

window.onload=function(){

        // Oculta ou mostra campo conjuge

        document.getElementById('TIPO').addEventListener('change', function () {
            var style = this.value;
            switch (style) {
                case 'F':
                style = this.value =='F' ? 'block':'none';
                document.getElementById('fisica').style.display = style;
                document.getElementById('juridica').style.display = 'none';		
                    break;
                case 'J':
                style = this.value =='J' ? 'block':'none';
                document.getElementById('juridica').style.display = style;
                document.getElementById('fisica').style.display = 'none';		
                    break;
                default:
                document.getElementById('juridica').style.display = 'none';
                    break;
            }
        });
}


var options = {
    onKeyPress: function (cpf, ev, el, op) {
        var masks = ['000.000.000-000', '00.000.000/0000-00'];
        $('.cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
    }
}



$(document).ready(function(){
    $('#CTT_CELULAR').mask('(99) 99999-9999');
    $('#CO_CELULAR').mask('(99) 99999-9999');
    $('#CTT_FONE').mask('(99) 9999-9999');
    $('#CPF_CNPJ').mask('000.000.000-00');
    $('#CPF').mask('000.000.000-00');
    $('#DES_CPF').mask('000.000.000-00');
    $('#RPL_CTT_FONE').mask('(99) 9999-9999');
    $('#RPL_CTT_CELULAR').mask('(99) 99999-9999');
    $('#CNPJ').mask('00.000.000/0000-00');
    
});

//verificando o tipo de pessoa e colocando a máscara da view user
$('.type_person').on('change', function(){
if($(this).val() == 'J'){
  $('.cpf_cnpj').mask('00.000.000/0000-00', {reverse: true});
}else if($(this).val() == 'F'){
  $('.cpf_cnpj').mask('000.000.000-00', {reverse: true});
}
});



*/

$('#cpf').mask('###.###.###-##');
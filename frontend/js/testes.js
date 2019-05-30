// rotate icon when opening collapse
$('.collapse-rotate-icon').on('hide.bs.collapse', function () {
  $(this).siblings('.card-header').find('.fa-chevron-down').attr('data-fa-transform', 'rotate-0');
});

// rotate icon when close collapse
$('.collapse-rotate-icon').on('show.bs.collapse', function () {
  $(this).siblings('.card-header').find('.fa-chevron-down').attr('data-fa-transform', 'rotate-180');
});


$.ajaxSetup({
  headers:
  {
      'X-CSRF-Token': $('input[name="_token"]').val()
  }
});    

$(document).ready(function() {
// MÁSCARA PARA TELEFONES
var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
    field.mask(SPMaskBehavior.apply({}, arguments), options);
  }
};
$('.sp_celphones').mask(SPMaskBehavior, spOptions);

});

//verificando o tipo de pessoa e colocando a máscara da view user
$('.type_person').on('change', function(){
if($(this).val() == 'J'){
  $('.cpf_cnpj').mask('00.000.000/0000-00', {reverse: true});
}else if($(this).val() == 'F'){
  $('.cpf_cnpj').mask('000.000.000-00', {reverse: true});
}
});

$('.btnResponsible').on('click', function() {
if($(this).hasClass("click")){
  $(this).removeClass('click');
  $('.inputResponsible').css('display', 'none');
}else{
  $(this).addClass('click');
  $('.inputResponsible').css('display', 'block');
}
});

//$(".chosen-select").chosen({no_results_text: "Oops, Nenhum resultado encontrado!"});

// CONSULTA CEP

function limpa_formulário_cep() {
//Limpa valores do formulário de cep.
document.getElementById('logradouro').value=("");
document.getElementById('bairro').value=("");
document.getElementById('cidade').value=("");
document.getElementById('uf').value=("");
document.getElementById('codibge').value=("");
}

function meu_callback(conteudo) {
if (!("erro" in conteudo)) {
//Atualiza os campos com os valores.
document.getElementById('logradouro').value=(conteudo.logradouro);
document.getElementById('bairro').value=(conteudo.bairro);
document.getElementById('cidade').value=(conteudo.localidade);
document.getElementById('uf').value=(conteudo.uf);
document.getElementById('codibge').value=(conteudo.ibge);
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
  document.getElementById('logradouro').value="...";
  document.getElementById('bairro').value="...";
  document.getElementById('cidade').value="...";
  document.getElementById('uf').value="...";
  document.getElementById('codibge').value="...";

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

// Botão Flutuante
function toggleBtn(botao){
var elemento;
switch(botao){
  case 1: elemento = $(".btnPesquisarInput input"); break;
  case 2: elemento = $(".btnMaisBotoesGrupo"); break;
  //case 3: Clique aqui para saber mais sobre o diálogo!
  }

if(elemento.is(":visible")){
  elemento.hide(300);
}else{
  elemento.show(300);
  // elemento.focus(); -- Focar o campo caso seja texto
}

// Se quiser que o botão pesquisa feche ao desfocar o input
// $(".btnPesquisarInput input").blur(function(){ toggleBtn(1); });
}

$(".btnPesquisarBtn button, .btnMaisBotoesBtn button, .btnSupEsquerdo button").click(function(){
var botao = $(this).attr("name");
botao = parseInt(botao);
toggleBtn(botao);
});
};


// Oculta ou mostra os campos
window.onload=function(){
      
document.getElementById('pis').addEventListener('change', function () {
var style = this.value;
  switch (style) {
    case '01':
    style = this.value =='01' ? 'block':'none';
    document.getElementById('pis_div').style.display = style;		
      break;
      case '02':
    style = this.value =='02' ? 'block':'none';
    document.getElementById('pis_div').style.display = style;		
      break;
      case '49':
    style = this.value =='49' ? 'block':'none';
    document.getElementById('pis_div').style.display = style;		
      break;
    default:
    document.getElementById('pis_div').style.display = 'none';
      break;
  }
});

document.getElementById('cofins').addEventListener('change', function () {
  var style = this.value;
    switch (style) {
      case '01':
      style = this.value =='01' ? 'block':'none';
      document.getElementById('hidden_div').style.display = style;		
        break;
        case '02':
        style = this.value =='02' ? 'block':'none';
      document.getElementById('hidden_div').style.display = style;		
        break;
        case '49':
        style = this.value =='49' ? 'block':'none';
      document.getElementById('hidden_div').style.display = style;		
        break;
        default:
        document.getElementById('hidden_div').style.display = 'none';
        break;
      
    }
  });
  document.getElementById('icms').addEventListener('change', function () {
    var style = this.value;
      switch (style) {
        case '00':
        style = this.value =='00' ? 'block':'none';
        document.getElementById('icms_div').style.display = style;		
          break;
          case '10':
          style = this.value =='10' ? 'block':'none';
        document.getElementById('icms_div').style.display = style;		
          break;
          case '20':
          style = this.value =='20' ? 'block':'none';
        document.getElementById('icms_div').style.display = style;		
          break;
          case '70':
          style = this.value =='70' ? 'block':'none';
        document.getElementById('icms_div').style.display = style;		
          break;
          case '90':
          style = this.value =='90' ? 'block':'none';
        document.getElementById('icms_div').style.display = style;		
          break;
          default:
          document.getElementById('icms_div').style.display = 'none';
          break;
        
      }
    });
    document.getElementById('ipi_ent').addEventListener('change', function () {
      var style = this.value;
        switch (style) {
          case '00':
          style = this.value =='00' ? 'block':'none';
          document.getElementById('ipi_div').style.display = style;		
            break;
            case '49':
            style = this.value =='49' ? 'block':'none';
          document.getElementById('ipi_div').style.display = style;		
            break;
      
            default:
            document.getElementById('ipi_div').style.display = 'none';
            break;
          
        }
      });
      document.getElementById('ipi_saida').addEventListener('change', function () {
        var style = this.value;
          switch (style) {
            case '50':
            style = this.value =='50' ? 'block':'none';
            document.getElementById('ipis_div').style.display = style;		
              break;
              case '99':
              style = this.value =='99' ? 'block':'none';
            document.getElementById('ipis_div').style.display = style;		
              break;
        
              default:
              document.getElementById('ipis_div').style.display = 'none';
              break;
            
          }
      });
      document.getElementById('regime').addEventListener('change', function () {
        var style = this.value;
          switch (style) {
            case '900':
            style = this.value =='900' ? 'block':'none';
            document.getElementById('regime_div').style.display = style;		
              break;
              default:
              document.getElementById('regime_div').style.display = 'none';
              break;
            
          }
        });
        document.getElementById('regime').addEventListener('change', function () {
          var style = this.value;
            switch (style) {
              
        case '101':
        style = this.value =='101' ? 'block':'none';
        document.getElementById('cred_div').style.display = style;		
          break;
          
          case '201':
          style = this.value =='201' ? 'block':'none';
        document.getElementById('cred_div').style.display = style;		
            break;
            case '900':
            style = this.value =='900' ? 'block':'none';
        document.getElementById('cred_div').style.display = style;		
            break;

            default:
        document.getElementById('cred_div').style.display = 'none';
            break;
              
            }
          });


          document.getElementById('regime').addEventListener('change', function () {
            var style = this.value;
              switch (style) {
                
          case '201':
          style = this.value =='201' ? 'block':'none';
          document.getElementById('st_div').style.display = style;		
            break;
            
            case '202':
            style = this.value =='202' ? 'block':'none';
          document.getElementById('st_div').style.display = style;		
              break;
            case '203':
            style = this.value =='203' ? 'block':'none';
          document.getElementById('st_div').style.display = style;		
                break;
              case '900':
              style = this.value =='900' ? 'block':'none';
          document.getElementById('st_div').style.display = style;		
              break;

              default:
          document.getElementById('st_div').style.display = 'none';
              break;
                
              }
            });
            document.getElementById('icms').addEventListener('change', function () {
            var style = this.value;
            switch (style) {
                  
            case '10':
            style = this.value =='10' ? 'block':'none';
            document.getElementById('st_div').style.display = style;		
              break;
              
              case '30':
              style = this.value =='30' ? 'block':'none';
            document.getElementById('st_div').style.display = style;		
                break;

              case '70':
              style = this.value =='70' ? 'block':'none';
            document.getElementById('st_div').style.display = style;		
                break;
                
                default:
            document.getElementById('st_div').style.display = 'none';
                break;
                  
                }
              });

} 

@extends('layouts.app')

@section('conteudo')


<!--Navbar Inicial-->
<nav class="navbar navbar-light d-flex justify-content-center" style="background-color: #62b9d1; color: white;">
    <div class="form-inline m-2">
        <span class="mr-2" style="font-size:20px;">Consulta de </span>
        <select class="form-control mr-2 espec" >
            <option value="" selected disabled>selecione uma especialidade...</option>
            @foreach ($especialidades as $i)
                <option value="{{ $i['especialidade_id'] }}">{{ $i['nome'] }}</option>
            @endforeach            
        </select>
        <a class="btn btn-success form-control agendar" >AGENDAR</a>
    </div>
</nav>

<!--Modais dos profissionais localizados-->
<span class="h4 mt-4 data-info"></span>
<div class="card-columns mt-2 profissionais"></div>

<div class="modal fade modal-xl" id="adengamentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preencha seus dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="ajax-form-submit">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <input type="hidden" name="specialty_id">
        <input type="hidden" name="professional_id">

        <div class="form-row">
            <div class="col col-md-6 mb-3">
                <label for="name">Nome Completo</label>
            <input type="text" name="name" class="form-control" placeholder="Nome completo" required>
            </div>
            <div class="col col-md-6 mb-3 ">
                <label for="source_id">Como Conheceu?</label>
            <select  name="source_id" class="form-control" placeholder="" required>
                <option value="" selected disabled></option>
                @foreach ($origem as $i)
                    <option value="{{ $i['origem_id'] }}">{{ $i['nome_origem'] }}</option>
                @endforeach
            </select>
            </div>
            <div class="col col-md-6 mb-3">
                <label for="birthdate">Nascimento</label>
            <input type="date"  name="birthdate" class="form-control" placeholder="Nascimento" required>
            </div>
            <div class="col col-md-6 mb-3">
                <label for="cpf">CPF</label>
            <input type="text" name="cpf" class="form-control" id="cpf" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success solicitacao">SOLICITAR HORÁRIO</button>
      </div>
      </form>

    </div>
  </div>
</div>



<!-- Js da página para declaração das variáveis dos inputs e criação do card de agendamento-->
<script type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        $(".agendar").click(function(e){
            $('.profissionais').empty();
            
            var id = $(".espec").val();
                    $.ajax({
    
                        type:"GET",
                        url:"/clinica/profissionais/"+id,
                        success: function(data) {
                            var info = `${data.length} ${$(".espec option:selected").text()} encontrado${data.length>1?'s':''}`;
                            $('.data-info ').text(info);
    
                            $.each(data, function (i, d) {
                            var color= Math.floor((Math.random() * 256) + 1);
                            var imagem = d.foto ? d.foto: `//placehold.it/50/${color}`;
                            var newCard = `<div class="card">
                                                        <div class="row no-gutters">
                                                            <div class="col-auto m-2">
                                                                <img src="${imagem}" style="width:50px; heigth:50px;" class="img-fluid rounded-circle" alt="">
                                                            </div>
                                                            <div class="col m-2">
                                                                <div class="card-block px-2 ">
                                                                    <strong class="card-title">${d.nome}</strong><br>
                                                                    <small class="card-text">CRM: ${d.documento_conselho}</small><br>
                                                                    <a href="#" class="btn btn-success" style="color: white; border-radius: 5px;"data-toggle="modal" data-idspec="${$(".espec").val()}" data-idprof="${d.profissional_id}" data-target="#adengamentoModal" >AGENDAR</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`
                            $('.profissionais').append(newCard);                     
                            }); 
                        }
                    });
            
        });
    
        $("#ajax-form-submit").submit(function(e){
    
            var form = $("#ajax-form-submit");
    
                var form_data = $("#ajax-form-submit").serialize();
    
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });
    
                $.ajax({
    
                    type:"POST",
                    url:"/clinica/agendamento",
                    data : form_data,
                    success: function(data) {
                        console.log(data.obj);
                        if(data.code){
                            alert(data.msg);
                            
                        }
                        else{
                            alert(data.msg);
                        }
                        $('#ajax-form-submit').find("input[type=text],input[type=date] ,textarea,select").val("")
                        $('#adengamentoModal').modal('hide');
    
                    }
                });
                return false;
        });
    
        $('#adengamentoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) ;
        var profId = button.data('idprof') ;
        var especId = button.data("idspec");
    
        var modal = $(this);
        modal.find('input[name=professional_id]').val(profId);
        modal.find('input[name=specialty_id]').val(especId);
        });
    
    });
    </script>

@endsection
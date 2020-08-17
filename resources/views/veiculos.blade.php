@extends('layouts.appveiculo', ["current" => "veiculos"])

@section('body')
<div class="card border">
	<div class="card-body">
		<h5 class="card-title">Cadastro de Veículos</h5>
		<table class="table table-ordered table-hover" id="tabelaveiculos">
			<thead>
				<tr>
					<th>Id</th>
					<th>Placa</th>
					<th>Renavam</th>
					<th>Modelo</th>
					<th>Marca</th>
					<th>Ano</th>
                    <th>Proprietário</th>
                    <th>Ações</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
			
		</table>
		
	</div>
	<div class="card-footer">
		<button class="btn btn-sm btn-primary" role="button" onclick="novoVeiculo()">Novo Veículo</button>
	</div>
	
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgveiculos">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form-horizontal" id="formVeiculo">
				<div class="modal-header">
					<h5 class="modal-title">Novo Veículo</h5>					
				</div>
				<div class="modal-body">
					<input type="hidden" id="id" class="form-control">
					
					<div class="form-group">
						<label for="placaVeiculo" class="control-label">Placa</label>
						<div class="input-group">
							<input type="text" class="form-control"  maxlength="7" id="placaVeiculo" placeholder="Ex.: AAA1111">
						</div>						
					</div>

					<div class="form-group">
						<label for="renavamVeiculo" class="control-label">Renavam</label>
						<div class="input-group">
							<input type="text" class="form-control" id="renavamVeiculo" placeholder="Registro do veículo">
						</div>						
					</div>

					<div class="form-group">
						<label for="modeloVeiculo" class="control-label">Modelo</label>
						<div class="input-group">
							<input type="text" class="form-control" id="modeloVeiculo" placeholder="Modelo do veículo">
						</div>						
					</div>

                    <div class="form-group">
                        <label for="marcaVeiculo" class="control-label">Marca</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="marcaVeiculo" placeholder="Marca do veículo">
                        </div>                      
                    </div>

					<div class="form-group">
                        <label for="anoVeiculo" class="control-label">Ano</label>
                        <div class="input-group">
                            <input type="text" maxlength="4" data-mask="0000" class="form-control" id="anoVeiculo" placeholder="Ex.:2020">
                        </div>                      
                    </div>

                    <div class="form-group">
                        <label for="proprietarioVeiculo" class="control-label">Proprietário</label>
                        <div class="input-group">
                            <select class="form-control" id="proprietarioVeiculo" >
                            </select>    
                        </div>
                    </div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
					<button type="cancel" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
			
		</div>
		
	</div>
	
</div>


@endsection	

@section('javascript')
<script type="text/javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    
    function novoVeiculo() {
        $('#id').val('');
        $('#placaVeiculo').val('');
        $('#renavamVeiculo').val('');
        $('#modeloVeiculo').val('');
        $('#marcaVeiculo').val('');
        $('#anoVeiculo').val('');
        $('#proprietarioVeiculo').val('');
        $('#dlgveiculos').modal('show');
    }
    
    function carregarClientes() {
        $.getJSON('/api/clientes', function(data) { 
            for(i=0;i<data.length;i++) {
                opcao = '<option value ="' + data[i].id + '">' + 
                    data[i].name + '</option>';
                $('#proprietarioVeiculo').append(opcao);
            }
        });
    }
    
    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.placa + "</td>" +
            "<td>" + p.renavam + "</td>" +
            "<td>" + p.modelo + "</td>" +
            "<td>" + p.marca + "</td>" +
            "<td>" + p.ano + "</td>" +
            "<td>" + p.proprietario + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editar(id) {
        $.getJSON('/api/veiculos/'+id, function(data) { 
            console.log(data);
            $('#id').val(data.id);
            $('#placaVeiculo').val(data.placa);
            $('#renavamVeiculo').val(data.renavam);
            $('#modeloVeiculo').val(data.modelo);
            $('#marcaVeiculo').val(data.marca);
            $('#anoVeiculo').val(data.id);
            $('#proprietarioVeiculo').val(data.id);
            $('#dlgveiculos').modal('show');            
        });        
    }
    
    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/veiculos/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaveiculos>tbody>tr");
                e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
    function carregarVeiculos() {
        $.getJSON('/api/veiculos', function(veiculos) { 
            for(i=0;i<veiculos.length;i++) {
                linha = montarLinha(veiculos[i]);
                $('#tabelaveiculos>tbody').append(linha);
            }
        });        
    }
    
    function criarVeiculo() {
        prod = { 
            nome: $("#placaVeiculo").val(), 
            placa : $("#placaVeiculo").val(),
            renavam : $("#renavamVeiculo").val(),
            modelo : $("#modeloVeiculo").val(),
            marca : $("#marcaVeiculo").val(),
            ano : $("#anoVeiculo").val(),
            proprietario : $("#proprietarioVeiculo").val() 
        };
        $.post("/api/veiculos", prod, function(data) {
            Veiculo = JSON.parse(data);
            linha = montarLinha(Veiculo);
            $('#tabelaveiculos>tbody').append(linha);            
        });
    }
    
    function salvarVeiculo() {
        prod = { 
            id : $("#id").val(),
            placa : $("#placaVeiculo").val(),
            renavam : $("#renavamVeiculo").val(),
            modelo : $("#modeloVeiculo").val(),
            marca : $("#marcaVeiculo").val(),
            ano : $("#anoVeiculo").val(),
            proprietario : $("#proprietarioVeiculo").val()
        };
        $.ajax({
            type: "PUT",
            url: "/api/veiculos/" + prod.id,
            context: this,
            data: prod,
            success: function(data) {
                prod = JSON.parse(data);
                linhas = $("#tabelaveiculos>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == prod.id );
                });
                if (e) {
                    e[0].cells[0].textContent = prod.id;
                    e[0].cells[1].textContent = prod.placa;
                    e[0].cells[2].textContent = prod.renavam;
                    e[0].cells[3].textContent = prod.modelo;
                    e[0].cells[4].textContent = prod.marca;
                    e[0].cells[5].textContent = prod.ano;
                    e[0].cells[6].textContent = prod.proprietario;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    $("#formVeiculo").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
            salvarVeiculo();
        else
            criarVeiculo();
            
        $("#dlgveiculos").modal('hide');
    });
    
    $(function(){
        carregarClientes();
        carregarVeiculos();
    })
    
    $('#placaVeiculo').mask('SSSYYYY', {'translation': {
        //A: {pattern: /[A-Za-z0-9]/},
        S: {pattern: /[A-Za-z]/},
        Y: {pattern: /[0-9]/}
    }
});
</script>
@endsection
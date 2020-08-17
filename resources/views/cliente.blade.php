@extends('layouts.appveiculo', ["current" => "veiculos"])

@section('body')
<div class="card border">
	<div class="card-body">
		<h5 class="card-title">Visualizar veículos</h5>
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
				</tr>
			</thead>
			<tbody>
				
			</tbody>
			
		</table>
		
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
            "</tr>";
        return linha;
    }
 
    
    function carregarVeiculos() {
        $.getJSON('/api/veiculos', function(veiculos) { 
            for(i=0;i<veiculos.length;i++) {
                linha = montarLinha(veiculos[i]);
                $('#tabelaveiculos>tbody').append(linha);
            }
        });        
    }
    
    $(function(){
        carregarClientes();
        carregarVeiculos();
    })
    
</script>
@endsection
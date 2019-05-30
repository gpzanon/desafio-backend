@extends('layouts.admin')

@section('conteudo')

<section>

    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>OPS!</strong> Ocorreu um erro ao salvar.
                @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif						
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible bg-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Sucesso!</strong> Operação realizada com sucesso.
            
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        </div>
    @endif
    {{ Form::open( ['method' => 'POST','url'=>'criar', 'class' => 'form-group', 'files' => true]) }}
        
        <div class="col-12">
            <button type="submit" class="btn btn-secondary my-2 mr-1" title="Salvar"><i class="fas fa-save"></i></button>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Excluir"><i class="fas fa-trash"></i></a>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Imprimir"><i class="fas fa-print"></i></a>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Simular Preço"><i class="fas fa-calculator"></i></a>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Histórico de Compras"><i class="fas fa-truck"></i></a>
            <a href="#" class="btn btn-secondary my-2 mr-1" title="Histórico de Vendas"><i class="fas fa-cart-arrow-down"></i></a>
        </div>

    <!-- Informações Gerais -->
    
        <div class="form-group"></div>
        <div class="row" id="fisica">
            <div class="form-group col-md-4">
                {!! Form::label('CPF', 'CPF', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('CPF', null, array('required','id'=>'CPF', 'class' => 'form-control ', 'placeholder' => 'Somente Nº', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('DES_NOME', 'Nome', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('DES_NOME', null, array('required', 'class' => 'form-control', 'placeholder' => 'Nome completo', 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <h4>Contato</h4>
        <div class="form-group"></div>
        <div class="row">
            <div class="form-group col-md-3">
                {!! Form::label('CELULAR', 'Celular', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('CELULAR', null, array('required', 'class' => 'form-control', 'placeholder' => 'Celular', 'autocomplete' => 'off')) !!}
            </div>                                
            <div class="form-group col-md-6">
                {!! Form::label('EMAIL', 'E-Mail', ['class' => 'fw-5 mb-1']) !!}
                {!! Form::text('EMAIL', null, array('required','class' => 'form-control', 'placeholder' => 'exemplo@exemplo.com', 'autocomplete' => 'off')) !!}
            </div>
        </div>
    {{ Form::close() }}
</section>

@stop
   
@section('scripts')
<script src="{{asset('js/ cliente.js')}}"></script>
@endsection
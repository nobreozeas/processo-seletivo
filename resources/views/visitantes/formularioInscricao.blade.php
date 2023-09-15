@extends('layouts.layout-guest')
@section('header')
    Formulário - <span class="fw-normal">Inscrição</span>
@stop

@section('content')

@if (Session::has('success'))
	<div class="alert alert-success alert-dismissible fade show">
		{{ Session::get('success') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
@endif
<div class="card">
    <form class="form-validate-jquery" method='POST' action="{{ route('inscricao.store') }}" enctype='multipart/form-data' novalidate>
        @csrf
        <div class="card-body">
			<div class="fw-bold border-bottom pb-2 mb-3">Dados do Processo Seletivo</div>
			<div class="row mb-3">
				<label class="col-form-label col-lg-3">Vaga<span class="text-danger">*</span></label>
				<div class="col-lg-9">
					<select name="id_processo_seletivo_curso" class="form-select" required="">
						<option value="">Escolha uma vaga abaixo</option>
						    {{ $old = '' }}
							@foreach ($vagas as $vaga)
								@if ($vaga->processo_seletivo != $old)
									@if ($old != '')
										</optgroup>
									@endif
									{{ $old = $vaga->processo_seletivo}}
									<optgroup label="{{ $vaga->processo_seletivo }}">
								@endif
									<option value="{{ $vaga->id }}" {{ (@$id_vaga == $vaga->id)? 'selected': '' }}> {{ $vaga->municipio }} / {{ $vaga->titulo }}</option>
							@endforeach
							</optgroup>
					</select>
				</div>
			</div>

			<div class="fw-bold border-bottom pb-2 mb-3">Dados de Inscrição</div>
            <p class="mb-4">NOTA: Por favor, leia com atenção os campos e preencha corretamente as informações abaixo.</p>
            <div class="row mb-3">
				<label class="col-form-label col-lg-3">Nome Completo <span class="text-danger">*</span></label>
				<div class="col-lg-9">
					<input type="text" name="nome" class="form-control" required="" placeholder="Nome completo sem abreviações" aria-invalid="false">
				</div>
			</div>
            <div class="row mb-3">
				<label class="col-form-label col-lg-3">Data de Nascimento <span class="text-danger">*</span></label>
				<div class="col-lg-9">
					<input type="date" name="data_nascimento" class="form-control" required="" aria-invalid="false">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-form-label col-lg-3">Tipo de Documento <span class="text-danger">*</span></label>
				<div class="col-lg-4">
					<select name="id_tipo_documento" class="form-select" required="">
						<option value="">Escolha um tipo de documento abaixo</option>
						@foreach (@$tipo_documentos as $tipo)
							<option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-3">Número do documento <span class="text-danger">*</span></label>
				<div class="col-lg-4">
					<input type="text" name="numero_documento" class="form-control" required="" placeholder="Ex: 12345678901" aria-invalid="false">
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-3">Endereço<span class="text-danger">*</span></label>
				<div class="col-lg-9">
					<input type="text" name="endereco" class="form-control" required="" placeholder="Ex: Rua 7 de Setembro, 000" aria-invalid="false">
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-3">Bairro</label>
				<div class="col-lg-4">
					<input type="text" name="bairro" class="form-control" placeholder="Ex: Centro" aria-invalid="false">
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-3">Número para contato (DDD + número (somente número)) <span class="text-danger">*</span></label>
				<div class="col-lg-3">
					<input type="text" name="numero_contato" class="form-control" required="" placeholder="68999999999">
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-form-label col-lg-3">Email <span class="text-danger">*</span></label>
				<div class="col-lg-9">
					<input type="email" name="email" class="form-control" required id="email" placeholder="Adicione um email válido" aria-invalid="true">
				</div>
			</div>

			<div class="fw-bold border-bottom pb-2 mb-3">Documentos Comprobatórios</div>

            <div class="card">
				<div class="card-header">
					<h5 class="mb-0">Currículo Vitae <code>(PDF)</code></h5>
				</div>
				<div class="card-body">
					<p class="fw-semibold">Pré visualização</p>
					<input type="file" name="anexo_curriculo[]" class="file-input-required" accept=".pdf" multiple>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Documento com foto (RG, CNH, Carteira de Identidade Profissional) <code>(PDF, JPG, JPEG)</code></h5>
				</div>
				<div class="card-body">
					<p class="mb-3">Exemplo de documentos (com foto): RG, Passaporte, Carteira de Trabalho.</p>
					<p class="fw-semibold">Pré visualização</p>
					<input type="file" name="anexo_documento[]" class="file-input-required" accept=".jpg,.jpeg,.pdf" multiple>
				</div>
			</div>

            <div class="card">
				<div class="card-header">
					<h5 class="mb-0">Comprovante de Escolaridade <code>(PDF, JPG, JPEG)</code></h5>
				</div>
				<div class="card-body">
					<p class="fw-semibold">Pré visualização</p>
					<input type="file" name="anexo_escolaridade[]" class="file-input" multiple="multiple" accept=".jpg,.png,.jpeg,.pdf">
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Titulação (Especialização, Mestrado, Doutorado) <code>(PDF, JPG, JPEG)</code></h5>
				</div>
				<div class="card-body">
					<p class="fw-semibold">Pré visualização</p>
					<input type="file" name="anexo_titulacao[]" class="file-input" multiple="multiple" accept=".jpg,.png,.jpeg,.pdf">
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Qualificação e aperfeiçoamento profissional <code>(PDF, JPG, JPEG)</code></h5>
				</div>
				<div class="card-body">
					<p class="fw-semibold">Pré visualização</p>
					<input type="file" name="anexo_qualificacao[]" class="file-input" multiple="multiple" accept=".jpg,.png,.jpeg,.pdf">
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Experiência Profissional <code>(PDF, JPG, JPEG)</code></h5>
				</div>
				<div class="card-body">
					<p class="fw-semibold">Pré visualização</p>
					<input type="file" name="anexo_experiencia_profissional[]" class="file-input" multiple="multiple" accept=".jpg,.png,.jpeg,.pdf">
				</div>
			</div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Fazer Inscrição </button>
            </div>
        </div>
    </form>
</div>
@stop

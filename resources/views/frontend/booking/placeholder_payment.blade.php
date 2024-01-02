@extends('frontend.layout.master')

@section('title', 'Pagamento Pendente')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Pagamento Pendente</h2>
                <p>{{ $placeholderMessage }}</p>
                <p>Agradecemos o seu interesse em se hospedar no Iguaçu Plaza Hotel. A funcionalidade de pagamento está atualmente em desenvolvimento e estará disponível em breve.</p>
                <p>Você será notificado assim que a opção de pagamento estiver implementada. Agradecemos pela sua paciência!</p>
            </div>
        </div>
    </div>
@endsection

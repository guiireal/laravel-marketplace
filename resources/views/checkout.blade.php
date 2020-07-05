@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="post">
                <input type="hidden" id="session-id" value="{{session()->get('pagseguro_session_code')}}">
                <input type="hidden" id="card-brand">
                <input type="hidden" id="purchase-total" value="{{$purchaseTotal}}">
                <input type="hidden" id="process-url" value="{{route('checkout.process')}}">
                <input type="hidden" id="thanks-url" value="{{route('checkout.thanks')}}">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="card-name">
                            Nome no Cartão
                        </label>
                        <input type="text" class="form-control" id="card-name" name="card_name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="card-number">
                            Número do Cartão
                            <span class="brand"> </span>
                        </label>
                        <input type="text" class="form-control" id="card-number" name="card_number">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="card-month">Mês de Expiração</label>
                        <input type="text" class="form-control" id="card-month" name="card_month">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="card-year">Ano de Expiração</label>
                        <input type="text" class="form-control" id="card-year" name="card_year">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="card-cvv">Código de Segurança</label>
                        <input type="text" class="form-control" id="card-cvv" name="card_cvv">
                    </div>
                    <div class="col-md-12 form-group" data-action="installments">
                    </div>
                </div>
                <button class="btn btn-success btn-lg" data-action="process">Efetuar Pagamento</button>
            </form>
        </div>
    </div>
@endsection

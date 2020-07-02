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
                </div>
                <button class="btn btn-success btn-lg">Efetuar Pagamento</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script
        src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script type="text/javascript">
        var sessionId = '{{session()->get('pagseguro_session_code')}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
        var cardNumber = document.querySelector("input[name='card_number']");
        var spanBrand = document.querySelector('span.brand');
        cardNumber.addEventListener('keyup', function () {
            if (this.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: this.value.substr(0, 6),
                    success: function (response) {
                        spanBrand.innerHTML = "<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/" + response.brand.name + ".png' alt='brand'/>";
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            }
        });
    </script>
@endsection

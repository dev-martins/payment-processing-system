@include('layouts.header')
@include('alerts.danger')

<div class="container mb-3 mt-3">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentChecked" id="paymentChecked1" value="boleto" checked>
        <label class="form-check-label" for="paymentChecked1">
            Boleto
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentChecked" id="paymentChecked2" value="card">
        <label class="form-check-label" for="paymentChecked2">
            Cartão
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentChecked" id="paymentChecked3" value="pix">
        <label class="form-check-label" for="paymentChecked3">
            Pix
        </label>
    </div>
    <!--form-->
    <div class="col-6">
        @include('forms.form-boleto')
        @include('forms.form-card')
        @include('forms.form-pix')
    </div>
    <!--end form-->
    <!-- Conteúdo da página -->
</div>

@include('layouts.footer')



<form id="formBoleto">
    <div class="mb-3 mt-3" method="post" action="/payment/agradecimento">
        <label for="bar_code" class="form-label">Código de barras</label>
        @if(isset($paymentData['identificationField']))
        <input type="text" class="form-control" id="bar_code" value="{{$paymentData['identificationField']}}" readonly>
        @else
        <input type="text" class="form-control" id="bar_code" value="">
        @endif
        <div class="row">
            <div class="col-md-6">
                <label for="scheduleDate" class="form-label">Agendar pagamento</label>
                <input type="text" class="form-control" id="scheduleDate" placeholder="2023-05-21">
            </div>
            <div class="col-md-6">
                <label for="description" class="form-label">Descrever</label>
                <input type="text" class="form-control" id="description" placeholder="Churrasco">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="dueDate" class="form-label">Data vencimento</label>
                @if(isset($paymentData['dueDate']))
                <input type="text" class="form-control" id="dueDate" placeholder="2023-05-30" value="{{isset($paymentData) ? $paymentData['dueDate'] : ''}}" readonly>
                @else
                <input type="text" class="form-control" id="dueDate" placeholder="2023-05-30" value="" readonly>
                @endif
            </div>
            <div class="col-md-6">
                <label for="value" class="form-label">Valor</label>
                @if(isset($paymentData['value']))
                <input type="text" class="form-control" id="value" placeholder="20.01" value="{{isset($paymentData) ? $paymentData['value'] : ''}}" readonly>
                @else
                <input type="text" class="form-control" id="value" placeholder="20.01" value="" readonly>
                @endif
            </div>
        </div>
    </div>
    @if(isset($paymentData['identificationField']))
    <button type="button" id="create" class="btn btn-primary">Pagar boleto</button>
    @else
    <a href="/billing" class="btn btn-primary">Criar conta</a>
    @endif
</form>

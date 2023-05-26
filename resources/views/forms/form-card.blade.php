<form style="display:none" id="formCard">
    <div class="mb-3 mt-3">
        <legend>Informações do titular do cartão</legend>
        <div class="row">
            <div class="col-md-6">
                <label for="holderName" class="form-label">Nome do títular</label>
                <input type="text" class="form-control" id="holderName" name="holderName" placeholder="Claudio H S Martins">
            </div>
            <div class="col-md-6">
                <label for="number" class="form-label">Número do cartão</label>
                <input type="text" class="form-control" id="number" name="number" placeholder="5136 8189 3358 2109">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="expiryMonth" class="form-label">Mês vencimento cartão</label>
                <input type="number" class="form-control" id="expiryMonth" name="expiryMonth" placeholder="10">
            </div>
            <div class="col-md-6">
                <label for="expiryYear" class="form-label">Ano de vencimento do cartão</label>
                <input type="number" class="form-control" id="expiryYear" name="expiryYear" placeholder="2023">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="ccv" class="form-label">CVV</label>
                <input type="number" class="form-control" id="ccv" name="ccv" placeholder="930">
            </div>
        </div>
        <legend class="mb-3 mt-3">Informações pessoais</legend>
        <div class="row">
            <div class="col-md-6">
                <label for="name" class="form-label">Nome completo</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Claudio Henrique da Silva Martins">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="chrystelle989@uorak.com">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="cpfCnpj" class="form-label">CPF/CNPJ</label>
                <input type="text" class="form-control" id="cpfCnpj" name="cpfCnpj" placeholder="24971563792">
            </div>
            <div class="col-md-6">
                <label for="postalCode" class="form-label">CEP</label>
                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="89223-005">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="addressNumber" class="form-label">Número</label>
                <input type="text" class="form-control" id="addressNumber" name="addressNumber" placeholder="277">
            </div>
            <div class="col-md-6">
                <label for="addressComplement" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="addressComplement" name="addressComplement" placeholder="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="mobilePhone" class="form-label">Celular</label>
                <input type="text" class="form-control" id="mobilePhone" name="mobilePhone" placeholder="47998781877">
            </div>
        </div>
        <legend class="mb-3 mt-3">Informações dp pagamento</legend>
        <div class="row">
            <div class="col-md-6">
                <label for="dueDate" class="form-label">Data de vencimento</label>
                @if(isset($paymentData['dueDate']))
                <input type="text" class="form-control" id="dueDate" name="dueDate" value="{{isset($paymentData) ? $paymentData['dueDate'] : ''}}" readonly>
                @else
                <input type="text" class="form-control" id="dueDate" name="dueDate" placeholder="2023-05-30">
                @endif
            </div>
            <div class="col-md-6">
                <label for="value" class="form-label">Valor</label>
                @if(isset($paymentData['value']))
                <input type="number" class="form-control" id="value" name="value" value="{{isset($paymentData) ? $paymentData['value'] : ''}}" readonly>
                @else
                <input type="number" class="form-control" id="value" name="value" placeholder="20.01">
                @endif
            </div>
        </div>
    </div>
    <button type="submit" id="payCard" class="btn btn-primary">Pagar</button>
</form>

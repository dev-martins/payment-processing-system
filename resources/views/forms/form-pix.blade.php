<form style="display:none" id="formPix" method="post" action="/payment/agradecimento">
    <div class="mb-3 mt-3">
        <div class="row">
            <div class="col-md-6">
                <label for="value" class="form-label">Valor</label>

                @if(isset($paymentData['value']))
                <input type="text" class="form-control" id="value" name="value" value="{{isset($paymentData) ? $paymentData['value'] : ''}}" readonly>
                @else
                <input type="text" class="form-control" id="value" name="value">
                @endif
                <label for="description" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="col-md-6">
                <label for="qrCode" class="form-label">QRCode</label>
                <input type="text" class="form-control" id="qrCode" name="qrCode" readonly>
                <input type="hidden" class="form-control" id="encodedImage" name="encodedImage">
                <label for="scheduleDate" class="form-label">Data agendamento</label>
                <input type="text" class="form-control" id="scheduleDate" name="scheduleDate" placeholder="2023-05-21">
                @if(isset($paymentData['payId']))
                <input type="hidden" class="form-control" id="payId" name="payId" value="{{isset($paymentData) ? $paymentData['payId'] : ''}}"  readonly>
                @endif
            </div>
        </div>
    </div>
    <button type="submit" id="payPix" class="btn btn-primary" disabled>Pagar</button>
</form>

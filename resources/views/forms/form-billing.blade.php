<form id="formBilling" method="post" action="/payment">
    <div class="mb-3 mt-3">

        <div class="row">
            <div class="col-md-6">
                <label for="description" class="form-label">Descrever</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Churrasco">
            </div>
            <div class="col-md-6">
                <label for="dueDate" class="form-label">Data de vencimento</label>
                <input type="text" class="form-control" id="dueDate" name="dueDate" placeholder="2023-05-30">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="value" class="form-label">valor</label>
                <input type="text" class="form-control" name="value" id="value" placeholder="20.01">
                <input type="hidden" class="form-control" name="identificationField" id="identificationField">
                <input type="hidden" class="form-control" name="payId" id="payId">
                @csrf
            </div>
        </div>
    </div>
    <button type="button" id="createBilling" class="btn btn-primary">Criar</button>
    <button type="submit" id="pay" class="btn btn-primary" disabled>Pagar</button>
</form>

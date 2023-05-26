@include('layouts.header')
<div class="container mb-3 mt-3">
    <div class="alert alert-success" role="alert">
        Obrigado! Para mais detalhes confira aqui <a href="{{$linkTransaction['linkTransaction']}}" class="alert-link" target="_blank">Detalhes do pagamento</a>.
    </div>
</div>
@include('layouts.footer')

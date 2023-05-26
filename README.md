# Systema de processamento de pagamentos!

## Como rodar o projeto?

 1. copiar o arquivo .env.example para .env e inserir nas seguintes variáveis os dados referentes a sua conta Asaas.
```config 
ASAAS_API_KEY=''
ASAAS_API_DOMAIN=''
CUSTOMER_ID=''
```
 2. No terminal na raiz do projeto rodar o seguinte comando:
 ```bash 
 docker-compose up -d --build 
 docker exec -it app-payment-system bash 
 composer install
```
 Após rodar esses comandos basta acessar no navegador *http://localhost:83/billing* criar uma conta e depois na página *http://localhost:83/payment* escolher entre as opções de pagamento **boleto, pix ou cartão de crédito**

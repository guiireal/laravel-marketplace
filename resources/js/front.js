import './bootstrap';
import * as PagSeguro from './components/PagSeguro';
import {drawSelectInstallments} from "./components/html/Select";
import toastr from 'toastr';

(() => {
    const cardNumber = document.querySelector("input[name='card_number']");
    const spanBrand = document.querySelector('span.brand');
    PagSeguro.setSessionId(document.getElementById('session-id').value);
    const purchaseTotal = document.getElementById('purchase-total').value;
    cardNumber.addEventListener('keyup', async ({target}) => {
        if (target.value.length >= 6) {
            try {
                const {brand: {name: brandName}} = await PagSeguro.getBrand(target.value.substr(0, 6));
                spanBrand.innerHTML = `<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${brandName}.png' alt='brand'/>`;
                document.getElementById('card-brand').value = brandName;
                const {installments} = await PagSeguro.getInstallments(purchaseTotal, brandName);
                document.querySelector("div[data-action='installments']").innerHTML = drawSelectInstallments(installments[brandName]);
            } catch (error) {
                console.log(error);
            }
        }
    });
    const submitButton = document.querySelector("button[data-action='process']");
    submitButton.addEventListener('click', async event => {
        event.preventDefault();
        try {
            const {card: {token}} = await PagSeguro.createCardToken(
                document.getElementById('card-number').value,
                document.getElementById('card-brand').value,
                document.getElementById('card-cvv').value,
                document.getElementById('card-month').value,
                document.getElementById('card-year').value,
            );
            const {data: {data}} = await PagSeguro.processPayment(
                token,
                document.getElementById('card-name').value,
                document.getElementById('select-installment').value,
                document.querySelector("meta[name='csrf-token']").content,
                document.getElementById('process-url').value
            );
            toastr.success(data.message, 'Sucesso');
            window.location.href = `${document.getElementById('thanks-url').value}?order=${data.order}`;
        } catch (error) {
            console.log(error);
        }
    });
})();

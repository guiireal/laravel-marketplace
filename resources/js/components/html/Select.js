export function drawSelectInstallments(installments) {
    let select = '<label>Opções de Parcelamento:</label>';
    select += '<select id="select-installment" class="form-control">';
    for (let l of installments) {
        select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
    }
    select += '</select>';
    return select;
}

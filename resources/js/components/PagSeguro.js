import '../vendor/pagseguro.directpayment';

export function setSessionId(sessionId) {
    window.PagSeguroDirectPayment.setSessionId(sessionId);
}

export function getBrand(cardBin) {
    return new Promise((resolve, reject) => {
        window.PagSeguroDirectPayment.getBrand({
            cardBin,
            success: response => resolve(response),
            error: error => reject(error),
        });
    });
}

export function getInstallments(amount, brand, maxInstallmentNoInterest = 0) {
    return new Promise((resolve, reject) => {
        window.PagSeguroDirectPayment.getInstallments({
            amount,
            brand,
            maxInstallmentNoInterest,
            success: response => resolve(response),
            error: error => reject(error),
        });
    });
}

export function createCardToken(cardNumber, brand, cvv, expirationMonth, expirationYear) {
    return new Promise((resolve, reject) => {
        window.PagSeguroDirectPayment.createCardToken({
            cardNumber,
            brand,
            cvv,
            expirationMonth,
            expirationYear,
            success: response => resolve(response),
            error: error => reject(error),
        });
    });
}

export function getSenderHash() {
    return window.PagSeguroDirectPayment.getSenderHash();
}

export function processPayment(cardToken, cardName, installment, csrfToken, urlProcess) {
    return new Promise(async (resolve, reject) => {
        try {
            const response = await axios.post(
                `${urlProcess}`,
                {
                    card_token: cardToken,
                    card_name: cardName,
                    hash: getSenderHash(),
                    installment,
                    _token: csrfToken
                });
            resolve(response);
        } catch (error) {
            reject (error);
        }
    });
}

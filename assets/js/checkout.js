import Toastify from 'https://cdn.jsdelivr.net/npm/toastify-js/+esm';

async function loadSdk () {
  if (window.JuspayCheckout) return;
  await new Promise((res, rej) => {
    const s = document.createElement('script');
    s.src = 'https://web-sdk.smartgateway.hdfcbank.com/checkout.js';
    s.onload = res;
    s.onerror = rej;
    document.head.appendChild(s);
  });
}

async function startCheckout () {
  const r = await fetch('libs/api/checkout_api.php', { method: 'POST' });
  const raw = await r.text();
  let data;
  try {
    data = JSON.parse(raw);
  } catch (err) {
    console.error('Invalid JSON from checkout_api.php:', raw);
    throw err;
  }
  if (!data.ok) return Swal.fire('Error', data.msg, 'error');

  await loadSdk();
  const p = data.payload;

  window.JuspayCheckout.open({
    paymentSession : p.sdkPayload.paymentSession ?? p.sdkPayload,
    merchantId     : p.sdkPayload.merchantId ?? undefined,
    amount         : (p.amount / 100).toFixed(2),
  }, async (result) => {
    if (result.status === 'SUCCESS') {
      const res = await fetch('libs/api/payment_verify_api.php', {
        method  : 'POST',
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' },
        body    : new URLSearchParams({ order_id: data.orderId }).toString(),
      });
      const out = await res.json();
      if (out.ok) {
        await Swal.fire('Payment Successful', 'Thank you for your purchase!', 'success');
        location.href = 'index.php';
      } else {
        Swal.fire('Verification failed', out.msg, 'error');
      }
    } else if (result.status === 'CANCELLED') {
      Toastify({ text: 'Payment cancelled', backgroundColor: '#f44336' }).showToast();
    } else {
      Swal.fire('Payment Failed', result.message || 'Please try again', 'error');
    }
  });
}

document.getElementById('checkoutBtn').addEventListener('click', startCheckout);
class ShoppingCart {
    static instance = null;
    
    static getInstance() {
        if (!ShoppingCart.instance) {
            ShoppingCart.instance = new ShoppingCart();
        }
        return ShoppingCart.instance;
    }

    constructor() {
        if (ShoppingCart.instance) {
            return ShoppingCart.instance;
        }

        this.cart = [];
        document.addEventListener('DOMContentLoaded', () => this.init());
    }

    /* ---------- lifecycle ---------- */
    async init() {
        await this.refresh();
        this.bindGlobalClicks();
    }

    /* ---------- helpers ---------- */
    async api(action, payload) {
        const body = new URLSearchParams({ action, ...payload });
        const r = await fetch('libs/api/cart_api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: body.toString()
        });
        return r.json();
    }

    async refresh() {
        const r = await fetch('libs/api/get_cart_items.php');
        const data = await r.json();
        if (!data.ok) throw data.msg;
        this.cart = data.items;
        this.draw();
    }

    subtotal() {
        return this.cart.reduce((t, i) => t + i.price * i.quantity, 0);
    }

    /* ---------- DOM ---------- */
    draw() {
        const cartDisplay = document.getElementById('Cart');
        const list = document.getElementById('CartItems');
        const sub  = document.getElementById('CartSubtotal');

        if (!list) return;
        if (this.cart.length) {
            list.innerHTML = this.cart.map(this.rowHTML).join('');
        } else {
            list.innerHTML = '<p class="text-center py-3">Your cart is empty.</p>';
        }

        if (sub) sub.textContent = `₹${this.subtotal().toFixed(2)}`;
    }

    rowHTML = (it) => `
        <div class="cart-item d-flex justify-content-between align-items-center border-bottom px-3 py-3 bg-light rounded-3 mb-2 shadow-sm">
            <div class="d-flex align-items-center flex-grow-1">
                <div class="cart-img-wrapper me-3">
                    <img src="${it.image}" alt="${it.title}" class="rounded border" style="width: 70px; height: 70px; object-fit: cover;">
                </div>
                <div>
                    <h6 class="mb-1 text-dark fw-semibold">${it.title}</h6>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <button class="btn btn-sm btn-outline-secondary js-dec rounded-circle" data-id="${it.id}" title="Decrease">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="fw-bold text-dark">${it.quantity}</span>
                        <button class="btn btn-sm btn-outline-secondary js-inc rounded-circle" data-id="${it.id}" title="Increase">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="mt-2">
                        <span class="text-primary fw-bold fs-6">₹${it.price.toFixed(2)}</span>
                    </div>
                </div>
            </div>
            <div class="ms-3">
                <button class="btn btn-sm btn-outline-danger rounded-circle js-del" data-id="${it.id}" title="Remove">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    `;

    /* ---------- events ---------- */
    bindGlobalClicks() {
        // Add-to-cart on catalog buttons
        document.addEventListener('click', e => {
            const btn = e.target.closest('[data-add-to-cart]');
            if (btn) this.handleAdd(btn.dataset.id);
        });

        // Cart sidebar clicks
        document.addEventListener('click', e => {
            const id = parseInt(e.target.closest('[data-id]')?.dataset.id || 0, 10);
            if (!id) return;

            if (e.target.closest('.js-inc'))  this.changeQty(id, 1);
            if (e.target.closest('.js-dec'))  this.changeQty(id, -1);
            if (e.target.closest('.js-del'))  this.remove(id);
        });
    }

    async handleAdd(prodId) {
        const res = await this.api('add', { product_id: prodId, quantity: 1 });
        if (!res.ok) return alert(res.msg);
        
        // Add the style to show the cart when an item is added
        const cartDisplay = document.getElementById('Cart');
        if (cartDisplay) {
            cartDisplay.style.display = 'block';
        }
        
        await this.refresh();
    }

    async changeQty(prodId, diff) {
        const item = this.cart.find(i => i.id === prodId);
        if (!item) return;
        const newQty = item.quantity + diff;
        if (newQty < 1) return this.remove(prodId);
        const res = await this.api('update', { product_id: prodId, quantity: newQty });
        if (!res.ok) return alert(res.msg);
        await this.refresh();
    }

    async remove(prodId) {
        const res = await this.api('remove', { product_id: prodId });
        if (!res.ok) return alert(res.msg);
        await this.refresh();
    }
}

// Then initialize with:
ShoppingCart.getInstance();
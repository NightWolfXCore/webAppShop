function renderCart() {

    const container = document.getElementById('cart-products-list');
    const empty = document.getElementById('cart-empty');

    const totalProducts = document.getElementById('cart-total-products');
    const totalPrice = document.getElementById('cart-total-price');

    const cart = getCart();

    if (!cart.length) {

        container.innerHTML = '';

        empty.style.display = 'flex';

        totalProducts.textContent = '0 ₽';
        totalPrice.textContent = '0 ₽';

        updateCartBadge();

        return;
    }

    empty.style.display = 'none';

    let total = 0;

    container.innerHTML = cart.map(item => {

        const itemTotal = item.price * item.quantity;

        total += itemTotal;

        return `
            <div class="cart-product">

                <img class="cart-product-image" src="/assets/img/${item.image}" alt="${item.title}">

                <div class="cart-product-body">

                    <div class="cart-product-title">
                        ${item.title}
                    </div>

                    <div class="cart-product-description">
                        ${item.description}
                    </div>

                    <div class="cart-product-price">
                        ${item.price} ₽
                    </div>

                </div>

                <div class="cart-product-actions">

                    <div class="cart-quantity">

                        <button class="cart-quantity-btn" onclick="changeQuantity(${item.id}, -1); renderCart();">
                            -
                        </button>

                        <span>${item.quantity}</span>

                        <button class="cart-quantity-btn" onclick="changeQuantity(${item.id}, 1); renderCart();">
                            +
                        </button>

                    </div>

                    <button class="cart-remove" onclick="removeFromCart(${item.id}); renderCart();">
                        Удалить
                    </button>

                </div>

            </div>
        `;

    }).join('');

    totalProducts.textContent = `${total} ₽`;
    totalPrice.textContent = `${total} ₽`;

    updateCartBadge();
}

document.addEventListener('DOMContentLoaded', renderCart);
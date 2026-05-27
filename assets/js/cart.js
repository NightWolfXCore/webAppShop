const CART_KEY = 'confectionery_cart';

function getCart() {
    const cart = localStorage.getItem(CART_KEY);

    return cart ? JSON.parse(cart) : [];
}

function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));

    updateCartBadge();
}

function addToCart(product) {
    const cart = getCart();

    const existingProduct = cart.find(item => item.id === product.id);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({
            ...product,
            quantity: 1
        });
    }

    saveCart(cart);
}

function removeFromCart(productId) {
    const cart = getCart().filter(item => item.id !== productId);

    saveCart(cart);
}

function changeQuantity(productId, amount) {
    const cart = getCart();

    const product = cart.find(item => item.id === productId);

    if (!product) {
        return;
    }

    product.quantity += amount;

    if (product.quantity <= 0) {
        removeFromCart(productId);

        return;
    }

    saveCart(cart);
}

function getCartCount() {
    const cart = getCart();

    return cart.reduce((total, item) => {
        return total + item.quantity;
    }, 0);
}

function updateCartBadge() {

    const cartCount = getCartCount();

    const headerBadge = document.getElementById('cartCount');

    if (headerBadge) {
        headerBadge.textContent = cartCount;
    }

    const cartPageCount = document.getElementById('cartPageCount');

    if (cartPageCount) {
        cartPageCount.textContent = cartCount;
    }
}

document.addEventListener('DOMContentLoaded', () => {

    updateCartBadge();

    document.querySelectorAll('.add-to-cart').forEach(button => {

        button.addEventListener('click', () => {

            const product = {
                id: Number(button.dataset.id),
                title: button.dataset.title,
                description: button.dataset.description,
                price: Number(button.dataset.price),
                image: button.dataset.image
            };

            addToCart(product);
        });

    });

});
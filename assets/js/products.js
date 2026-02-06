function updateStock(selectElement, productId) {
    const selectSize = selectElement.options[selectElement.selectedIndex];
    const selectedSize = selectSize.value;

    const stock = selectSize.getAttribute('stock') || '0';
    const showStock = document.getElementById('stock-' + productId);

    if (!selectedSize) {
        showStock.textContent = '--';
        showStock.className = 'inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700';
    } else if (stock && parseInt(stock, 10) > 0) {
        showStock.textContent = stock + ' units';
        showStock.className = 'inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700';
    } else {
        showStock.textContent = 'Out of Stock';
        showStock.className = 'inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-700';
    }
}

function deleteProduct(productId) {
    const selectSize = document.getElementById('size-select-' + productId);
    const selectedSize = selectSize.value;
    
    if (!selectedSize) {
        let userConfirmation = confirm("Are you sure you want to delete this product without selecting a size? This will delete all sizes of the product.");

        if (!userConfirmation) {
            return;
        }

        const url = `../../actions/admin/deleteProduct.php?id=${productId}`;
        window.location.href = url;
        return;
    }
    
    const url = `../../actions/admin/deleteProduct.php?id=${productId}&size=${selectedSize}`;
    window.location.href = url;
}
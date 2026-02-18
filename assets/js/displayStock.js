function updateStockDisplay(productId, totalStock) {
    const select = document.getElementById('size-select-' + productId);
    const stockDisplay = document.getElementById('stock-display-' + productId);
    const selectedOption = select.options[select.selectedIndex];

    const totalStockValue = parseInt(totalStock || 0, 10);
    let stock;
    if (selectedOption.value === '') {
        stock = totalStockValue;
    } else {
        stock = parseInt(selectedOption.getAttribute('data-stock') || '0', 10);
    }

    stockDisplay.textContent = stock;

    if (stock <= 10) {
        stockDisplay.classList.add('text-red-600', 'font-semibold');
        stockDisplay.classList.remove('text-gray-600');
    } else {
        stockDisplay.classList.remove('text-red-600', 'font-semibold');
        stockDisplay.classList.add('text-gray-600');
    }
}
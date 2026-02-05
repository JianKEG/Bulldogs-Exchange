function updateStock(selectElement, productId) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const stock = selectedOption.getAttribute('stock') || '0';
    const stockElement = document.getElementById('stock-' + productId);
    const sizeName = selectedOption.value;

    if (sizeName === '') {
        stockElement.textContent = '--';
        stockElement.className = 'inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700';
    } else if (stock && parseInt(stock, 10) > 0) {
        stockElement.textContent = stock + ' units';
        stockElement.className = 'inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700';
    } else {
        stockElement.textContent = 'Out of Stock';
        stockElement.className = 'inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-700';
    }
}

function updateStock(selectElement, productId) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const stock = selectedOption.getAttribute('stock');
    const stockElement = document.getElementById('stock-' + productId);
    
    if (stock === null || stock === 'all') {
        stockElement.textContent = '--';
        stockElement.className = 'inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700';
        return;
    }
    
    const stockQty = parseInt(stock);
    let stockClass = 'bg-gray-100 text-gray-700';
    let displayText = 'Out of Stock';
    
    if (stockQty > 10) {
        stockClass = 'bg-green-100 text-green-700';
        displayText = stockQty + ' units';
    } else if (stockQty > 0) {
        stockClass = 'bg-red-100 text-red-700';
        displayText = stockQty + ' units';
    } else {
        stockClass = 'bg-red-100 text-red-700';
        displayText = 'Out of Stock';
    }
    
    stockElement.textContent = displayText;
    stockElement.className = 'inline-flex items-center rounded-full ' + stockClass + ' px-3 py-1 text-sm font-medium';
}

function deleteProduct(productId) {
    const selectSize = document.getElementById('size-select-' + productId);

    if (!selectSize) {
        let userConfirmation = confirm("Are you sure you want to delete this product? This action cannot be undone.");

        if (!userConfirmation) {
            return;
        }

        const url = `../../actions/admin/product/deleteProduct.php?id=${productId}`;
        window.location.href = url;
        return;
    }
    
    const selectedSize = selectSize.value;
    
    if (selectedSize === 'all') {
        let userConfirmation = confirm("Are you sure you want to delete this product? This will delete all sizes of the product. This action cannot be undone.");

        if (!userConfirmation) {
            return;
        }

        const url = `../../actions/admin/product/deleteProduct.php?id=${productId}`;
        window.location.href = url;
        return;
    }
    
    let userConfirmation = confirm(`Are you sure you want to delete size "${selectedSize}" from this product? This action cannot be undone.`);
    
    if (!userConfirmation) {
        return;
    }
    
    const url = `../../actions/admin/product/deleteProduct.php?id=${productId}&size=${selectedSize}`;
    window.location.href = url;
}

function editProduct(productId) {
    const selectSize = document.getElementById('size-select-' + productId);

    if (!selectSize) {
        const url = `../../pages/admin/product/editProduct.php?id=${productId}&size=No%20Size`;
        window.location.href = url;
        return;
        
    }

    const selectedSize = selectSize.value;
    
    if (!selectedSize) {
        const url = `../../pages/admin/product/editProduct.php?id=${productId}`;
        window.location.href = url;
        return;
    }
    
    const url = `../../pages/admin/product/editProduct.php?id=${productId}&size=${selectedSize}`;
    window.location.href = url;
}
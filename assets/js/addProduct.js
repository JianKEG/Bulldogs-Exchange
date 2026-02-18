const categoryRadios = document.querySelectorAll('input[name="category"]');
const sizeToggleSection = document.getElementById('size-toggle-section');

function updateSizeDisplay() {
    const selectedCategory = document.querySelector('input[name="category"]:checked')?.value;
    if (selectedCategory === 'Merchandise') {
        sizeToggleSection.style.display = 'block';
        toggleSizeMode();
    } else if (selectedCategory === 'Uniform') {
        sizeToggleSection.style.display = 'none';
        document.getElementById('size-mode-required').style.display = 'block';
        document.getElementById('size-mode-optional').style.display = 'none';
    } else {
        // No category selected
        sizeToggleSection.style.display = 'none';
        document.getElementById('size-mode-required').style.display = 'none';
        document.getElementById('size-mode-optional').style.display = 'none';
    }
}

function toggleSizeMode() {
    const hasSizes = document.querySelector('input[name="has_sizes"]:checked')?.value;
    const sizeRequired = document.getElementById('size-mode-required');
    const sizeOptional = document.getElementById('size-mode-optional');
    
    if (hasSizes === 'yes') {
        sizeRequired.style.display = 'block';
        sizeOptional.style.display = 'none';
    } else {
        sizeRequired.style.display = 'none';
        sizeOptional.style.display = 'block';
    }
}

categoryRadios.forEach(radio => {
    radio.addEventListener('change', updateSizeDisplay);
});

updateSizeDisplay();

document.getElementById('imageInput').addEventListener('change', function(event) {
    const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('imagePreview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block'; 
        }
});

function updateSizeOptions() {
    const allSelects = document.querySelectorAll('select[name="sizes[]"]');
    const selectedSizes = [];

    allSelects.forEach(select => {
        if (select.value && select.value !== '') {
            selectedSizes.push(select.value);
        }
    });

    allSelects.forEach(select => {
        const currentValue = select.value;
        const options = select.querySelectorAll('option');
        
        options.forEach(option => {
            if (option.value === '') {
                option.disabled = false;
            } else if (selectedSizes.includes(option.value) && option.value !== currentValue) {
                option.disabled = true;
            } else {
                option.disabled = false;
            }
        });
    });
}

function addSizeRow() {
    const container = document.getElementById('size-container');
    const newRow = document.createElement('div');
    newRow.classList.add('flex', 'gap-2', 'mb-2', 'size-row');
    newRow.innerHTML = `
        <select name="sizes[]" class="w-1/2 p-2 border rounded-md" onchange="updateSizeOptions()">
            <option value="">-- Select Size --</option>
            <option value="XS">XS</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>
        <input type="number" name="stocks[]" placeholder="Stock Qty" required class="w-1/2 p-2 border rounded-md">

        <button type="button" onclick="removeSizeRow(this)" class="text-red-600 hover:text-red-800 transition cursor-pointer">
            <svg class="h-5.5 w-5.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </button>
    `;
    
    container.appendChild(newRow);
    updateSizeOptions();
}

function removeSizeRow(button) {
    button.parentElement.remove();
    updateSizeOptions();
}

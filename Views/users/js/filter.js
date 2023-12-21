document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const booksContainer = document.querySelector('.container-fluid.d-flex.justify-content-center');

    searchInput.addEventListener('input', debounce(function () {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const bookCards = booksContainer.querySelectorAll('.card');

        for (const card of bookCards) {
            const title = card.querySelector('.card-title').innerText.toLowerCase();
            const description = card.querySelector('.card-text').innerText.toLowerCase();
            
            const found = title.includes(searchTerm) || description.includes(searchTerm);
            card.style.display = found ? '' : 'none';
        }
    }, 0));

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
});
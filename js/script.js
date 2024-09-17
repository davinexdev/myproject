document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        const nome = document.getElementById('nome').value;
        const email = document.getElementById('email').value;

        if (nome.trim() === '') {
            alert('O nome é obrigatório.');
            event.preventDefault();
        }

        if (!validateEmail(email)) {
            alert('Por favor, insira um email válido.');
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const tableRows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function() {
        const searchValue = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const nome = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (nome.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

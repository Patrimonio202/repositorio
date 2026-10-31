document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form').forEach(function (form) {
        const method = form.querySelector('input[name="_method"]');
        if (!method || method.value.toUpperCase() !== 'DELETE') return;

        form.classList.add('delete-form');
        form.addEventListener('submit', function (event) {
            if (!window.confirm('¿Seguro que deseas eliminar este registro? Esta acción no se puede deshacer.')) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('input[type="file"]').forEach(function (input) {
        input.addEventListener('change', function () {
            const label = input.closest('.form-group')?.querySelector('.file-selected-name');
            if (label) label.textContent = input.files[0]?.name || 'Ningún archivo seleccionado';
        });
    });
});

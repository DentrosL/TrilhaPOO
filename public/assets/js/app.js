document.addEventListener('DOMContentLoaded', function () {
    // Add confirmation to destructive forms (forms that contain a .btn.danger button)
    document.querySelectorAll('form').forEach(function (form) {
        if (form.querySelector('button.btn.danger')) {
            form.addEventListener('submit', function (e) {
                if (!confirm('Confirma exclusão? Esta ação é irreversível.')) {
                    e.preventDefault();
                }
            });
        }
    });

    // Client edit helper: populate edit form when select changes
    if (window.CLIENTS && Array.isArray(window.CLIENTS)) {
        var editForm = document.getElementById('edit-client-form');
        if (editForm) {
            var select = editForm.querySelector('select[name="cliente_id"]');
            var inputNome = editForm.querySelector('input[name="nome"]');
            var inputEmail = editForm.querySelector('input[name="email"]');
            var inputTelefone = editForm.querySelector('input[name="telefone"]');
            var inputCpf = editForm.querySelector('input[name="cpf"]');

            function populate(id) {
                var c = window.CLIENTS.find(function (it) { return parseInt(it.id, 10) === parseInt(id, 10); });
                if (!c) return;
                if (inputNome) inputNome.value = c.nome || '';
                if (inputEmail) inputEmail.value = c.email || '';
                if (inputTelefone) inputTelefone.value = c.telefone || '';
                if (inputCpf) inputCpf.value = c.cpf || '';
            }

            if (select) {
                select.addEventListener('change', function (e) { populate(e.target.value); });
                // populate initial
                if (select.value) populate(select.value);
            }
        }
    }
});

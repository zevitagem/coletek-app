var USER = function () {

    var state = {
        destroyButton: $('.destroy'),
        table: $('table#user')
    };

    function load() {

        state.destroyButton.click(function (e) {
            e.preventDefault();

            if (!confirm('Deseja realmente excluir esse registro?')) {
                return;
            }

            var button = $(this);
            var url = button.data('action'),
                    method = button.data('method');

            var l = Ladda.create(button.get(0));
            l.start();

            $.ajax({
                type: method,
                url: url,
                dataType: 'json',
                complete: function () {
                    l.stop();
                },
                success: function (data) {
                    if (data.status == false) {
                        return APP.addTopMessage(data.message);
                    }

                    alert(data.message);

                    button.closest('tr').remove();

                    if (state.table.find('tbody tr').length == 0) {
                        alert('Atenção, lista vazia, sua tela será recarregada!!!');
                        window.location.reload();
                    }
                }
            });
        })
    }

    return {load};
};

$(document).ready(function () {
    APP.load();
    USER().load();
});

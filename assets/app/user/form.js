var USER_FORM = function () {

    var state = {
        userForm: $('#user-form'),
        setor: $('#setor'),
        setoresAdicionadosBox: $('#setores-adicionados-box'),
        addSetorButton: $('#add-setor'),
        destroyButton: $('.destroy'),
        templateSetorAdicionadoHTML: $('#template-setor-adicionado').html(),
    };

    function load() {

        state.destroyButton.click(function (e) {
            e.preventDefault();

            var button = $(this);
            var url = button.attr('action'),
                    method = button.attr('method');

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
                    APP.addTopMessage(data.message);

                    if (data.status == false) {
                        return;
                    }
                    
                    alert('remove a linha')
                }
            });
        })

        state.addSetorButton.click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            var option = state.setor.find('option:selected'),
                    value = option.val();

            if (value <= 0) {
                return alert('Selecione um setor válido antes de tentar adicionar!');
            }

            var html = state.templateSetorAdicionadoHTML.slice(); //clone

            var element = $(html);
            element.find('label').text(option.text());
            element.find('input').val(value);

            state.setoresAdicionadosBox.append(element.prop("outerHTML"));
        });

        state.userForm.submit(function (e) {

            e.preventDefault();

            var form = $(this);
            var url = form.attr('action'),
                    method = form.attr('method'),
                    saveButton = form.find('button.ladda-button');

            var l = Ladda.create(saveButton.get(0));
            l.start();

            $.ajax({
                type: method,
                url: url,
                data: form.serialize(),
                dataType: 'json',
                complete: function () {
                    l.stop();
                },
                success: function (data) {
                    if (data.status == false) {
                        APP.addTopMessage(data.message);
                    } else {
                        APP.addTopMessage('');
                        alert(data.message);

                        window.location.href = data.url_callback;
                    }
                }
            });
        });

    }

    return {load, state};
};

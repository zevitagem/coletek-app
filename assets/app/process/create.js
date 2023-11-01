var PROCESS = function () {

    var state = {
        processForm: $('#process-form'),
        messageBox: $('#message-box')
    };

    function load() {

        state.processForm.submit(function (e) {

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
                success: function (data)
                {
                    if (data.status == false) {
                        state.messageBox.html(data.message);
                    } else {
                        state.messageBox.html('');
                        alert(data.message);
                    }
                }
            });
        });

    }

    return {load};
};

$(document).ready(function () {
    PROCESS().load();
});

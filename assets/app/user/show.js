var USER_SHOW = function () {

    var state = {};

    function load() {

        USER_FORM().load();
    }

    return {load};
};

$(document).ready(function () {
    APP.load();
    USER_SHOW().load();
});

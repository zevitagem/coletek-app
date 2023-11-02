var USER_CREATE = function () {

    var state = {};

    function load() {

        USER_FORM().load();
    }

    return {load};
};

$(document).ready(function () {
    APP().load();
    USER_CREATE().load();
});

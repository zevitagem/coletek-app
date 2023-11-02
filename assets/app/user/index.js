var USER = function () {

    var state = {};

    function load() {}

    return {load};
};

$(document).ready(function () {
    APP.load();
    USER().load();
});

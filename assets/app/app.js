var APP = (function () {

    var state = {
        topMessageBox: $('#top-message-box')
    };

    function load() {
        state.mobileCollapse = $('#mobile-collapse');
        state.queryValue = $('.main-search input[type="text"]');
    }

    function hideMenu() {
        if (state.mobileCollapse.children().hasClass('icon-toggle-right')) {
            state.mobileCollapse.click();
        }
    }

    function getQueryElement() {
        return state.queryValue;
    }

    function getQueryValue() {
        return state.queryValue.val().trim();
    }

    function addTopMessage(message) {
        state.topMessageBox.html(message);
    }

    return {load, hideMenu, getQueryElement, getQueryValue, addTopMessage};
})();




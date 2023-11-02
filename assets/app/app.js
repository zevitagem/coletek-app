var APP = function () {

    var state = {};

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

    return {load, hideMenu, getQueryElement, getQueryValue};
};




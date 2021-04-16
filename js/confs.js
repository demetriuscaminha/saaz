(function ($) {
    $(function () {
        var uri = window.location.href.toString();
        var url = window.location.href.split('?');
        var hash = window.location.href.split('#');
        var hasHash = (hash[1] != undefined && hash[1] == 'contact') ? true : false;
        var hasModal = (url[1] != undefined && url[1] == 'modal') ? true : false;

        if (hasHash) {
            $('html, body').animate({
                scrollTop: $('#' + hash[1]).offset().top
            }, 500);
        }

        if (hasModal) $('#modalConfirmacao').modal();

        const modalConfirmacao = $("#modalConfirmacao");
        if (modalConfirmacao.length != 0) {
            modalConfirmacao.on("click", function (e) {
                if (uri.indexOf("?") > 0) {
                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                    window.history.replaceState({}, document.title, clean_uri);
                }
            });
        }

        const modalConfirmacaoBtn2 = $("#btn-close-confirmacao");
        if (modalConfirmacaoBtn2.length != 0) {
            modalConfirmacaoBtn2.on("click", function(e) {
                if (uri.indexOf("?") > 0) {
                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                    window.history.replaceState({}, document.title, clean_uri);
                }
            });
        }

        const date = $(".cupomForm #datanasc");
        if (date.length != 0) {
            date.mask('00/00/0000');
        }
    });
})(jQuery);
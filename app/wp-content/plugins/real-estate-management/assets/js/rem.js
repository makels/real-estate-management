let REM = function() {

    this.resultEl = null;

    this.paginationEl = null;

    this.init = function() {
        let _this = this;
        this.resultEl = $('.rem_filter__found_result');
        this.paginationEl = $('.paginate').find('a');
        $(this.paginationEl).click(function() {
            let url = $(this).prop('href');
            _this.setFilter(url);
            return false;
        });
    }

    this.setFilter = function(url = '') {
        let _this = this;
        let data = {};
        let form_data = $('#rem_filter').serializeArray();
        $(this.resultEl).attr('style', 'opacity: .3');
        $.each(form_data, function(index, el) {
            data[el.name] = el.value;
        });
        url = url.split('?');
        $.ajax({
            url: url === '' ? '/wp-admin/admin-ajax.php': '/wp-admin/admin-ajax.php?' + url[1],
            type: 'get',
            dataType : 'html',
            data: data,
            success: function(content) {
                $(_this.resultEl).html(content);
                $(_this.resultEl).attr('style', 'opacity: 1');
                window.setTimeout(function() {
                    _this.init();
                },1000);
            },
            error: function() {
                let content = "<h3>Результаты поиска:</h3><p>Не найдено ни одного объекта</p>"
                $(_this.resultEl).html(content);
                $(_this.resultEl).attr('style', 'opacity: 1');
            },
        });

    }

}

document.rem = new REM();

$(function() {
    document.rem.init();
});
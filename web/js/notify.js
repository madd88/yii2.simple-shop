Notify = {
    TYPE_INFO: 0,
    TYPE_SUCCESS: 1,
    TYPE_WARNING: 2,
    TYPE_DANGER: 3,

    generate: function (aText, aOptHeader, aOptType) {
        var lTypeIndexes = [this.TYPE_INFO, this.TYPE_SUCCESS, this.TYPE_WARNING, this.TYPE_DANGER];
        var ltypes = ['alert-info', 'alert-success', 'alert-warning', 'alert-danger'];
        var ltype = 'alert-danger';

        if (aOptType !== undefined) {
            ltype = 'alert-' + aOptType;
        }

        var lText = '';
        if (aOptHeader) {
            lText += "<span>"+aOptHeader+"</span>";
        }
        lText += "<p>"+aText+"</p>";
        var lNotify_e = $("<div class='alert "+ltype+"'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>"+lText+"</div>");

        setTimeout(function () {
            lNotify_e.alert('close');
        }, 3000);
        lNotify_e.appendTo($("#notifies"));
    }
};
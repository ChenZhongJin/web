var __assign = (this && this.__assign) || Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
        s = arguments[i];
        for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
            t[p] = s[p];
    }
    return t;
};
function notify(_a) {
    var _b = _a === void 0 ? {} : _a, _c = _b.code, code = _c === void 0 ? 0 : _c, _d = _b.msg, msg = _d === void 0 ? "" : _d, _e = _b.url, url = _e === void 0 ? "" : _e, _f = _b.wait, wait = _f === void 0 ? 3 : _f;
    var statusMap = ['danger', 'success', 'paimary', 'info', 'warning'];
    if (typeof msg !== 'string' || !msg) {
        code = 4;
        msg = 'Warning';
    }
    var status = statusMap[code];
    var notifyTag = 'notify-' + Date.now();
    document.body.insertAdjacentHTML('afterbegin', "<div class=\"alert alert-" + status + " notification notify-" + status + " " + notifyTag + "\">" + msg + "</div>");
    setTimeout(function () {
        document.body.removeChild(document.querySelector('.' + notifyTag));
        url && (window.location.href = url);
    }, wait * 1000);
}
function ajax(url, data, method, options) {
    if (url === void 0) { url = ""; }
    if (data === void 0) { data = ""; }
    if (method === void 0) { method = "POST"; }
    $.ajax(__assign({ method: method }, options, { url: url, data: data, success: function (resp) { notify(resp); }, error: function (xhr, statusText) { notify({ msg: "Request.Status:" + xhr.status + ",Error:" + statusText }); } }));
}
var f = new FileReader();

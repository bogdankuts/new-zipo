/**
 * Created by BogdanKootz on 17.10.16.
 */
var setCookie = function (name, value, expires, path, domain, secure) { document.cookie = name + "=" + escape(value) +((expires) ? "; expires=" + expires : "") +((path) ? "; path=" + path : "") +((domain) ? "; domain=" + domain : "") +((secure) ? "; secure" : ""); };
var getCookie = function (name) { var cookie = " " + document.cookie; var search = " " + name + "="; var setStr = null; var offset = 0; var end = 0; if (cookie.length > 0) { offset = cookie.indexOf(search); if (offset != -1) { offset += search.length; end = cookie.indexOf(";", offset); if (end == -1) { end = cookie.length; } var setStr = unescape(cookie.substring(offset, end)); } } return(setStr); };
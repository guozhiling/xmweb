
$(function() {
    $("table.list tbody tr:not(.head)").hover(function() {
        $(this).addClass("hover")
    },
    function() {
        $(this).removeClass("hover")
    });
    LIBS.bindFocus($(".input_panel input:text,.input_panel input:password,input.input"));
    $(window).ajaxSend(function(g, a, b) {
        b.loading && (g = "", "string" == typeof b.loading && (g = b.loading), a.loadingOverlay = $("<div>").addClass("loading_overlay").append($("<div>").append($("<span>").text(g))).appendTo("body"))
    });
    $(window).ajaxComplete(function(g, a, b) {
        b.loading && a.loadingOverlay && a.loadingOverlay.remove()
    })
}); (function(g) {
    g.fn.delayClass = function(a, b) {
        var c = this;
        clearTimeout(this.data("_dc_timer_" + a));
        this.addClass(a);
        this.data("_dc_timer_" + a, setTimeout(function() {
            c.removeClass(a)
        },
        b))
    };
    g.fn.vals = function(a) {
        var b = [];
        g.isFunction(a) ? this.each(function() {
            var c = g(this).val(),
            c = a(c, this);
            b.push(c)
        }) : this.each(function() {
            b.push(g(this).val())
        });
        return b
    };
    g.fn.formData = function(a, b) {
        var c = {};
        g("input,select,textarea", this).each(function() {
            var d = g(this),
            e = d.prop("tagName").toLowerCase(),
            f = d.prop("type").toLowerCase();
            if ("input" != e || "radio" != f && "checkbox" != f || d.prop("checked")) if ((e = d.prop("name")) || (e = d.prop("id")), e && ((d = d.val()) || !a)) {
                f = c;
                if (!b) {
                    for (var h = e.split("."); 1 < h.length;) e = h.shift(),
                    null == f[e] && (f[e] = {}),
                    f = f[e];
                    e = h.shift()
                }
                /\[\]$/.test(e) ? (e = e.substr(0, e.length - 2), h = f[e], h || (h = [], f[e] = h), h.push(d)) : f[e] = d
            }
        });
        return c
    };
    g.fn.onlyNumber = function() {
        g(this).keypress(function(a) {
            a = a.which;
            return 0 == a || 13 == a || 8 == a || 48 <= a && 57 >= a ? !0 : !1
        })
    }
})($);
String.prototype.format = function() {
    var g = arguments;
    return this.replace(/{(\d+)}/g,
    function(a, b) {
        return g[b]
    })
};
String.prototype.padleft = function(g, a) {
    if (this.length < g) {
        a || (a = " ");
        for (var b = "",
        c = 0,
        d = g - this.length; c < d; c++) b += a;
        return b + this
    }
    return this
};
Array.prototype.indexOf = function(g) {
    for (var a = 0; a < this.length; a++) if (this[a] == g) return a;
    return - 1
};
Date.prototype.format = function(g) {
    var a = {
        "M+": this.getMonth() + 1,
        "d+": this.getDate(),
        "h+": this.getHours(),
        "m+": this.getMinutes(),
        "s+": this.getSeconds(),
        "q+": Math.floor((this.getMonth() + 3) / 3),
        S: this.getMilliseconds()
    };
    /(y+)/.test(g) && (g = g.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length)));
    for (var b in a)(new RegExp("(" + b + ")")).test(g) && (g = g.replace(RegExp.$1, 1 == RegExp.$1.length ? a[b] : ("00" + a[b]).substr(("" + a[b]).length)));
    return g
};
var LIBS = function() {
    function g(a, b, c) {
        a || (a = {});
        if (b) if ($.isArray(c)) for (var d = 0; d < c.length; d++) {
            var e = c[d],
            f = b[e],
            g = a[e];
            void 0 !== f && f !== g && (a[e] = f)
        } else for (e in b) f = b[e],
        g = a[e],
        void 0 !== f && f !== g && (a[e] = f);
        return a
    }
    return {
        NUMBERS: "\u96f6\u4e00\u4e8c\u4e09\u56db\u4e94\u516d\u4e03\u516b\u4e5d\u5341".split(""),
        clone: g,
        money: function(a, b, c) {
            void 0 !== b && (a = this.round(a, b, c));
            a = (a + "").split(".", 2);
            b = a[0];
            for (c = /(\d+)(\d{3})/; c.test(b);) b = b.replace(c, "$1,$2");
            1 < a.length && 0 < a[1].length && (b += "." + a[1]);
            return b
        },
        split: function(a, b, c) {
            var d = a.indexOf(b);
            if ( - 1 == d) return [a];
            for (var e = [a.substr(0, d)], d = d + b.length; d < a.length;) {
                var f = a.indexOf(b, d);
                if ( - 1 == f || e.length + 1 >= c) f = a.length;
                e.push(a.substring(d, f));
                d = f + b.length
            }
            return e
        },
        round: function(a, b, c) {
            if (null == a) return null;
            b || (b = 0);
            var d = Math.pow(10, b);
            a = Math.round(a * d) / d;
            if (0 < b && c) for (a += "", d = a.indexOf("."), -1 == d && (d = a.length, a += "."), c = 0, b -= a.length - d - 1; c < b; c++) a += "0";
            return a
        },
        combination: function(a, b) {
            if (a <= b) return 1;
            if (a == b + 1) return a;
            for (var c = a,
            d = a - 1; d > a - b; d--) c *= d;
            for (d = b; 1 < d; d--) c /= d;
            return c
        },
        replaceArray: function(a, b) {
            if (b) for (var c = [], d = 0; d < a.length; d++) {
                var e = b[a[d]];
                null == e ? c.push(a[d]) : c.push(e)
            }
            return c
        },
        comboArray: function(a, b, c) {
            null == c && (c = a.length);
            if (! (1 > b || 1 > c || b > c)) {
                for (var d = [], e = [], f = 0; f < b; f++) e[f] = f;
                for (;;) {
                    for (var g = [], f = 0; f < b; f++) g[f] = a[e[f]];
                    g.count = g[0].count;
                    for (var f = 1,
                    k = g.length; f < k; f++) g.count *= g[f].count;
                    d[d.length] = g;
                    for (g = f = b - 1; 0 <= f; f--) if (k = e[f] + 1, k >= c - g + f) {
                        if (0 == f) {
                            d.count = d[0].count;
                            f = 1;
                            for (k = d.length; f < k; f++) d.count += d[f].count;
                            return d
                        }
                    } else {
                        for (e[f] = k; f < g; f++) e[f + 1] = e[f] + 1;
                        break
                    }
                }
            }
        },
        comboList: function(a) {
            for (var b = [], c = [], d = a.length, e = 0; e < d; e++) c[e] = 0;
            for (;;) {
                for (var f = [], e = 0; e < d; e++) f[e] = a[e][c[e]];
                b.push(f);
                for (e = 0; e < d; e++) {
                    c[e] += 1;
                    if (c[e] < a[e].length) break;
                    if (e == d - 1) return b;
                    c[e] = 0
                }
            }
        },
        timeToString: function(a) {
            if (0 >= a) return "00:00";
            a = Math.floor(a / 1E3);
            var b = Math.floor(a / 60);
            a -= 60 * b;
            10 > b && (b = "0" + b);
            10 > a && (a = "0" + a);
            return "" + b + ":" + a
        },
        ajaxDefaultTimeout: 1E4,
        ajax: function(a, b, c) {
            a && !a.timeout && (a.timeout = this.ajaxDefaultTimeout);
            b || (b = 2);
            c || (c = 1E3);
            var d = {},
            e = 0,
            f = a.error,
            h = a.complete;
            a.error = function(h, l) {
                clearTimeout(d.errTimer);
                if ("timeout" == l || "error" == l && 503 == h.status) if (e += 1, e <= b || -1 == b) {
                    delay = e * e * c;
                    d.errTimer = setTimeout(function() {
                        d = g(d, $.ajax(a))
                    },
                    delay);
                    this.retryError = !0;
                    return
                }
                $.isFunction(f) && f.apply(this, arguments)
            };
            a.complete = function() { ! this.retryError && $.isFunction(h) && h.apply(this, arguments)
            };
            return d = $.ajax(a)
        },
        get: function(a, b, c, d, e, f) {
            jQuery.isFunction(b) && (f = e, e = d, d = c, c = b, b = void 0);
            "string" === typeof d || $.isArray(d) || (f = e, e = d, d = void 0);
            return this.ajax({
                url: a,
                type: "get",
                dataType: d,
                data: b,
                success: c
            },
            e, f)
        },
        colorMoney: function(a, b, c) { (b || c) && $(a).each(function() {
                var a = $(this),
                e = a.text();
                a.removeClass(b).removeClass(c);
                e && "0" != e && ("-" == e[0] && b ? a.addClass(b) : c && a.addClass(c))
            })
        },
        url: function(a, b) {
            if (!a) return location.href;
            void 0 === b && (b = a, a = location.pathname);
            var c = a.indexOf("?"),
            d = location.search;
            0 <= c && (d = a.substr(c), a = a.substring(0, c));
            c = a + "?";
            if (1 < d.length) for (var d = d.substr(1).split("&"), e = 0; e < d.length; e++) if (0 != d[e].length) {
                var f = d[e].split("=", 2);
                f[1] && void 0 === b[f[0]] && (b[f[0]] = decodeURIComponent(f[1]))
            }
            for (var g in b) b[g] && (c += g + "=" + encodeURIComponent(b[g]) + "&");
            return c = c.substr(0, c.length - 1)
        },
        getUrlParam: function(a, b) {
            b || (b = location.search);
            if (1 < b.length) {
                b = b.substr(1).split("&");
                for (var c = 0; c < b.length; c++) if (0 != b[c].length) {
                    var d = b[c].split("=", 2);
                    if (d[1] && d[0] == a) return decodeURIComponent(d[1])
                }
            }
        },
        equals: function(a, b) {
            for (var c in a) if (a[c] != b[c]) return ! 1;
            return ! 0
        },
        bindFocus: function(a) {
            a.focusin(function() {
                $(this).addClass("input_focus")
            }).focusout(function() {
                $(this).removeClass("input_focus")
            });
            return a
        },
        toMap: function(a, b, c) {
            if (null == a) return {};
            b || (b = ";");
            c || (c = "=");
            a = a.split(b);
            b = {};
            for (var d = 0; d < a.length - 1; d++) {
                var e = a[d].split(c, 2);
                2 == e.length && (b[e[0]] = e[1])
            }
            return b
        },
        cookie: function(a, b, c) {
            if ("undefined" != typeof b) {
                c = c || {};
                null === b && (b = "", c.expires = -1);
                var d = "";
                c.expires && ("number" == typeof c.expires || c.expires.toUTCString) && ("number" == typeof c.expires ? (d = new Date, d.setTime(d.getTime() + 864E5 * c.expires)) : d = c.expires, d = "; expires=" + d.toUTCString());
                var e = c.path ? "; path=" + c.path: "",
                f = c.domain ? "; domain=" + c.domain: "";
                c = c.secure ? "; secure": "";
                document.cookie = [a, "=", encodeURIComponent(b), d, e, f, c].join("")
            } else {
                b = null;
                if (document.cookie && "" != document.cookie) for (c = document.cookie.split(";"), d = 0; d < c.length; d++) if (e = jQuery.trim(c[d]), e.substring(0, a.length + 1) == a + "=") {
                    b = decodeURIComponent(e.substring(a.length + 1));
                    break
                }
                return b
            }
        }
    }
} ();
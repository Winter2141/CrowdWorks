/** @preserve jQuery.floatThead 2.1.2 - https://mkoryak.github.io/floatThead/ - Copyright (c) 2012 - 2018 Misha Koryak **/ ! function (ht) {
  ht.floatThead = ht.floatThead || {}, ht.floatThead.defaults = {
    headerCellSelector: "tr:visible:first>*:visible",
    zIndex: 99,
    position: "auto",
    top: 0,
    bottom: 0,
    scrollContainer: function (t) {
      return ht([])
    },
    responsiveContainer: function (t) {
      return ht([])
    },
    getSizingRow: function (t, e, o) {
      return t.find("tbody tr:visible:first>*:visible")
    },
    floatTableClass: "floatThead-table",
    floatWrapperClass: "floatThead-wrapper",
    floatContainerClass: "floatThead-container",
    copyTableClass: !0,
    autoReflow: !1,
    debug: !1,
    support: {
      bootstrap: !0,
      datatables: !0,
      jqueryUI: !0,
      perfectScrollbar: !0
    },
    floatContainerCss: {
      "overflow-x": "hidden"
    }
  };
  var vt = function () {
      var n = {},
        o = Object.prototype.hasOwnProperty;
      n.has = function (t, e) {
        return o.call(t, e)
      }, n.keys = Object.keys || function (t) {
        if (t !== Object(t)) throw new TypeError("Invalid object");
        var e = [];
        for (var o in t) n.has(t, o) && e.push(o);
        return e
      };
      var r = 0;
      return n.uniqueId = function (t) {
        var e = ++r + "";
        return t ? t + e : e
      }, ht.each(["Arguments", "Function", "String", "Number", "Date", "RegExp"], function () {
        var e = this;
        n["is" + e] = function (t) {
          return Object.prototype.toString.call(t) == "[object " + e + "]"
        }
      }), n.debounce = function (o, n, r) {
        var a, i, l, s, d;
        return function () {
          l = this, i = arguments, s = new Date;
          var e = function () {
              var t = new Date - s;
              t < n ? a = setTimeout(e, n - t) : (a = null, r || (d = o.apply(l, i)))
            },
            t = r && !a;
          return a || (a = setTimeout(e, n)), t && (d = o.apply(l, i)), d
        }
      }, n
    }(),
    bt = "undefined" != typeof MutationObserver,
    wt = function () {
      for (var t = 3, e = document.createElement("b"), o = e.all || []; t = 1 + t, e.innerHTML = "<!--[if gt IE " + t + "]><i><![endif]-->", o[0];);
      return 4 < t ? t : document.documentMode
    }(),
    t = /Gecko\//.test(navigator.userAgent),
    gt = /WebKit\//.test(navigator.userAgent);
  wt || t || gt || (wt = 11);
  var l = function () {
      if (gt) {
        var t = ht("<div>").css("width", 0).append(ht("<table>").css("max-width", "100%").append(ht("<tr>").append(ht("<th>").append(ht("<div>").css("min-width", 100).text("X")))));
        ht("body").append(t);
        var e = 0 == t.find("table").width();
        return t.remove(), e
      }
      return !1
    },
    mt = !t && !wt,
    yt = ht(window),
    Tt = t && window.matchMedia;
  if (!window.matchMedia || Tt) {
    var e = window.onbeforeprint,
      o = window.onafterprint;
    window.onbeforeprint = function () {
      e && e(), yt.triggerHandler("beforeprint")
    }, window.onafterprint = function () {
      o && o(), yt.triggerHandler("afterprint")
    }
  }

  function Ct(t) {
    var e = t[0].parentElement;
    do {
      if ("visible" != window.getComputedStyle(e).getPropertyValue("overflow")) break
    } while (e = e.parentElement);
    return e == document.body ? ht([]) : ht(e)
  }

  function xt(t) {
    window && window.console && window.console.error && window.console.error("jQuery.floatThead: " + t)
  }

  function jt(t) {
    var e = t.getBoundingClientRect();
    return e.width || e.right - e.left
  }

  function St() {
    var t = document.createElement("scrolltester");
    t.style.cssText = "width:100px;height:100px;overflow:scroll!important;position:absolute;top:-9999px;display:block", document.body.appendChild(t);
    var e = t.offsetWidth - t.clientWidth;
    return document.body.removeChild(t), e
  }

  function zt(t, e, o) {
    var n = o ? "outerWidth" : "width";
    if (l && t.css("max-width")) {
      var r = 0;
      o && (r += parseInt(t.css("borderLeft"), 10), r += parseInt(t.css("borderRight"), 10));
      for (var a = 0; a < e.length; a++) r += jt(e.get(a));
      return r
    }
    return t[n]()
  }
  ht.fn.floatThead = function (t) {
    if (t = t || {}, wt < 8) return this;
    var ut = null;
    if (vt.isFunction(l) && (l = l()), vt.isString(t)) {
      var r = t,
        a = Array.prototype.slice.call(arguments, 1),
        i = this;
      return this.filter("table").each(function () {
        var t = ht(this),
          e = t.data("floatThead-lazy");
        e && t.floatThead(e);
        var o = t.data("floatThead-attached");
        if (o && vt.isFunction(o[r])) {
          var n = o[r].apply(this, a);
          void 0 !== n && (i = n)
        }
      }), i
    }
    var pt = ht.extend({}, ht.floatThead.defaults || {}, t);
    if (ht.each(t, function (t, e) {
        t in ht.floatThead.defaults || !pt.debug || xt("Used [" + t + "] key to init plugin, but that param is not an option for the plugin. Valid options are: " + vt.keys(ht.floatThead.defaults).join(", "))
      }), pt.debug) {
      var e = ht.fn.jquery.split(".");
      1 == parseInt(e[0], 10) && parseInt(e[1], 10) <= 7 && xt("jQuery version " + ht.fn.jquery + " detected! This plugin supports 1.8 or better, or 1.7.x with jQuery UI 1.8.24 -> http://jqueryui.com/resources/download/jquery-ui-1.8.24.zip")
    }
    return this.filter(":not(." + pt.floatTableClass + ")").each(function () {
      var e = vt.uniqueId(),
        m = ht(this);
      if (m.data("floatThead-attached")) return !0;
      if (!m.is("table")) throw new Error('jQuery.floatThead must be run on a table element. ex: $("table").floatThead();');
      bt = pt.autoReflow && bt;
      var d = m.children("thead:first"),
        o = m.children("tbody:first");
      if (0 == d.length || 0 == o.length) return pt.debug && (0 == d.length ? xt("The thead element is missing.") : xt("The tbody element is missing.")), m.data("floatThead-lazy", pt), void m.unbind("reflow").one("reflow", function () {
        m.floatThead(pt)
      });
      m.data("floatThead-lazy") && m.unbind("reflow"), m.data("floatThead-lazy", !1);
      var y, n, r = !0,
        T = {
          vertical: 0,
          horizontal: 0
        };
      vt.isFunction(St) && (St = St());
      var f = 0;
      !0 === pt.scrollContainer && (pt.scrollContainer = Ct);
      var C = pt.scrollContainer(m) || ht([]),
        x = 0 < C.length,
        j = x ? ht([]) : pt.responsiveContainer(m) || ht([]),
        S = $(),
        z = null;
      "auto" === pt.position ? z = null : "fixed" === pt.position ? z = !1 : "absolute" === pt.position ? z = !0 : pt.debug && xt('Invalid value given to "position" option, valid is "fixed", "absolute" and "auto". You passed: ', pt.position), null == z && (z = x);
      var a = m.find("caption"),
        I = 1 == a.length;
      if (I) var L = "top" === (a.css("caption-side") || a.attr("align") || "top");
      var i = ht("<fthfoot>").css({
          display: "table-footer-group",
          "border-spacing": 0,
          height: 0,
          "border-collapse": "collapse",
          visibility: "hidden"
        }),
        W = !1,
        l = ht([]),
        H = wt <= 9 && !x && z,
        c = ht("<table/>"),
        u = ht("<colgroup/>"),
        p = m.children("colgroup:first"),
        h = !0;
      0 == p.length && (p = ht("<colgroup/>"), h = !1);
      var v = ht("<fthtr>").css({
          display: "table-row",
          "border-spacing": 0,
          height: 0,
          "border-collapse": "collapse"
        }),
        q = ht("<div>").css(pt.floatContainerCss).attr("aria-hidden", "true"),
        R = !1,
        s = ht("<thead/>"),
        b = ht('<tr class="size-row" aria-hidden="true"/>'),
        w = ht([]),
        g = ht([]),
        M = ht([]),
        E = ht([]);
      s.append(b), m.prepend(p), mt && (i.append(v), m.append(i)), c.append(u), q.append(c), pt.copyTableClass && c.attr("class", m.attr("class")), c.attr({
        cellpadding: m.attr("cellpadding"),
        cellspacing: m.attr("cellspacing"),
        border: m.attr("border")
      });
      var t = m.css("display");
      if (c.css({
          borderCollapse: m.css("borderCollapse"),
          border: m.css("border"),
          display: t
        }), x || c.css("width", "auto"), "none" === t && (R = !0), c.addClass(pt.floatTableClass).css({
          margin: 0,
          "border-bottom-width": 0
        }), z) {
        var k = function (t, e) {
          var o = t.css("position"),
            n = t;
          if (!("relative" == o || "absolute" == o) || e) {
            var r = {
              paddingLeft: t.css("paddingLeft"),
              paddingRight: t.css("paddingRight")
            };
            q.css(r), n = t.data("floatThead-containerWrap") || t.wrap(ht("<div>").addClass(pt.floatWrapperClass).css({
              position: "relative",
              clear: "both"
            })).parent(), t.data("floatThead-containerWrap", n), W = !0
          }
          return n
        };
        x ? (l = k(C, !0)).prepend(q) : (l = k(m), m.before(q))
      } else m.before(q);
      q.css({
        position: z ? "absolute" : "fixed",
        marginTop: 0,
        top: z ? 0 : "auto",
        zIndex: pt.zIndex,
        willChange: "transform"
      }), q.addClass(pt.floatContainerClass), U();
      var D = {
          "table-layout": "fixed"
        },
        F = {
          "table-layout": m.css("tableLayout") || "auto"
        },
        O = m[0].style.width || "",
        N = m.css("minWidth") || "";

      function A(t) {
        return t + ".fth-" + e + ".floatTHead"
      }

      function Q() {
        var t = 0;
        if (d.children("tr:visible").each(function () {
            t += ht(this).outerHeight(!0)
          }), "collapse" == m.css("border-collapse")) {
          var e = parseInt(m.css("border-top-width"), 10);
          parseInt(m.find("thead tr:first").find(">*:first").css("border-top-width"), 10) < e && (t -= e / 2)
        }
        b.outerHeight(t), w.outerHeight(t)
      }

      function U() {
        y = (vt.isFunction(pt.top) ? pt.top(m) : pt.top) || 0, n = (vt.isFunction(pt.bottom) ? pt.bottom(m) : pt.bottom) || 0
      }

      function G() {
        if (!r) {
          if (r = !0, z) {
            var t = zt(m, E, !0);
            l.width() < t && m.css("minWidth", t)
          }
          m.css(D), c.css(D), c.append(d), o.before(s), Q()
        }
      }

      function P() {
        r && (r = !1, z && m.width(O), s.detach(), m.prepend(d), m.css(F), c.css(F), m.css("minWidth", N), m.css("minWidth", zt(m, E)))
      }
      var V = !1;

      function X(t) {
        V != t && (V = t, m.triggerHandler("floatThead", [t, q]))
      }

      function Y(t) {
        z != t && (z = t, q.css({
          position: z ? "absolute" : "fixed"
        }))
      }

      function B() {
        var l, s = function () {
          var t, e = d.find(pt.headerCellSelector);
          if (h ? t = p.find("col").length : (t = 0, e.each(function () {
              t += parseInt(ht(this).attr("colspan") || 1, 10)
            })), t !== f) {
            f = t;
            for (var o, n = [], r = [], a = [], i = 0; i < t; i++) o = e.eq(i).text(), n.push('<th class="floatThead-col" aria-label="' + o + '"/>'), r.push("<col/>"), a.push(ht("<fthtd>").css({
              display: "table-cell",
              height: 0,
              width: "auto"
            }));
            r = r.join(""), n = n.join(""), mt && (v.empty(), v.append(a), E = v.find("fthtd")), b.html(n), w = b.find("th"), h || p.html(r), g = p.find("col"), u.html(r), M = u.find("col")
          }
          return t
        }();
        return function () {
          var t = q.scrollLeft();
          g = p.find("col");
          var e, o, n, r, a = (e = m, o = g, n = E, r = wt, mt ? n : r ? pt.getSizingRow(e, o, n) : o);
          if (a.length == s && 0 < s) {
            if (!h)
              for (l = 0; l < s; l++) g.eq(l).css("width", "");
            P();
            var i = [];
            for (l = 0; l < s; l++) i[l] = jt(a.get(l));
            for (l = 0; l < s; l++) M.eq(l).width(i[l]), g.eq(l).width(i[l]);
            G()
          } else c.append(d), m.css(F), c.css(F), Q();
          q.scrollLeft(t), m.triggerHandler("reflowed", [q])
        }
      }

      function K(t) {
        var e = C.css("border-" + t + "-width"),
          o = 0;
        return e && ~e.indexOf("px") && (o = parseInt(e, 10)), o
      }

      function $() {
        return "auto" == j.css("overflow-x")
      }

      function J() {
        var i, l = C.scrollTop(),
          s = 0,
          d = I ? a.outerHeight(!0) : 0,
          f = L ? d : -d,
          c = q.height(),
          u = m.offset(),
          p = 0,
          h = 0;
        if (x) {
          var t = C.offset();
          s = u.top - t.top + l, I && L && (s += d), p = K("left"), h = K("top"), s -= h
        } else i = u.top - y - c + n + T.horizontal;
        var v = yt.scrollTop(),
          b = yt.scrollLeft(),
          w = function () {
            return ($() ? j : C).scrollLeft() || 0
          },
          g = w();
        return function (t) {
          S = $();
          var e = m[0].offsetWidth <= 0 && m[0].offsetHeight <= 0;
          if (!e && R) return R = !1, setTimeout(function () {
            m.triggerHandler("reflow")
          }, 1), null;
          if (e && (R = !0, !z)) return null;
          if ("windowScroll" == t) v = yt.scrollTop(), b = yt.scrollLeft();
          else if ("containerScroll" == t)
            if (j.length) {
              if (!S) return;
              g = j.scrollLeft()
            } else l = C.scrollTop(), g = C.scrollLeft();
          else "init" != t && (v = yt.scrollTop(), b = yt.scrollLeft(), l = C.scrollTop(), g = w());
          if (!gt || !(v < 0 || b < 0)) {
            if (H) Y("windowScrollDone" == t);
            else if ("windowScrollDone" == t) return null;
            var o, n;
            u = m.offset(), I && L && (u.top += d);
            var r = m.outerHeight();
            if (x && z) {
              if (l <= s) {
                var a = s - l + h;
                o = 0 < a ? a : 0, X(!1)
              } else o = W ? h : l, X(!0);
              n = p
            } else !x && z ? (i + r + f < v ? o = r - c + f : u.top >= v + y ? (o = 0, P(), X(!1)) : (o = y + v - u.top + s + (L ? d : 0), G(), X(!0)), n = g) : x && !z ? (l < s || r < l - s ? (o = u.top - v, P(), X(!1)) : (o = u.top + l - v - s, G(), X(!0)), n = u.left + g - b) : x || z || (i + r + f < v ? o = r + y - v + i + f : u.top > v + y ? (o = u.top - v, G(), X(!1)) : (o = y, X(!0)), n = u.left + g - b);
            return {
              top: Math.round(o),
              left: Math.round(n)
            }
          }
        }
      }

      function Z() {
        var i = null,
          l = null,
          s = null;
        return function (t, e, o) {
          if (null != t && (i != t.top || l != t.left)) {
            if (8 === wt) q.css({
              top: t.top,
              left: t.left
            });
            else {
              var n = "translateX(" + t.left + "px) translateY(" + t.top + "px)",
                r = {
                  "-webkit-transform": n,
                  "-moz-transform": n,
                  "-ms-transform": n,
                  "-o-transform": n,
                  transform: n,
                  top: 0
                };
              r[/rtl/i.test(document.documentElement.dir || "") ? "right" : "left"] = 0, q.css(r)
            }
            i = t.top, l = t.left
          }
          e && function () {
            var t = zt(m, E, !0),
              e = S ? j : C,
              o = e.length ? jt(e[0]) : t,
              n = "hidden" != e.css("overflow-y") ? o - T.vertical : o;
            if (q.width(n), x) {
              var r = 100 * t / n;
              c.css("width", r + "%")
            } else c.outerWidth(t)
          }(), o && Q();
          var a = (S ? j : C).scrollLeft();
          z && s == a || (q.scrollLeft(a), s = a)
        }
      }

      function _() {
        if (C.length)
          if (pt.support && pt.support.perfectScrollbar && C.data().perfectScrollbar) T = {
            horizontal: 0,
            vertical: 0
          };
          else {
            if ("scroll" == C.css("overflow-x")) T.horizontal = St;
            else {
              var t = C.width(),
                e = zt(m, E),
                o = n < r ? St : 0;
              T.horizontal = t - o < e ? St : 0
            }
            if ("scroll" == C.css("overflow-y")) T.vertical = St;
            else {
              var n = C.height(),
                r = m.height(),
                a = t < e ? St : 0;
              T.vertical = n - a < r ? St : 0
            }
          }
      }
      _();
      var tt = function () {
        B()()
      };
      tt();
      var et = J(),
        ot = Z();
      ot(et("init"), !0);
      var nt = vt.debounce(function () {
          ot(et("windowScrollDone"), !1)
        }, 1),
        rt = function () {
          ot(et("windowScroll"), !1), H && nt()
        },
        at = function () {
          ot(et("containerScroll"), !1)
        },
        it = vt.debounce(function () {
          m.is(":hidden") || (_(), U(), tt(), et = J(), ot(et("reflow"), !0, !0))
        }, 1),
        lt = function () {
          P()
        },
        st = function () {
          G()
        },
        dt = function (t) {
          t.matches ? lt() : st()
        },
        ft = null;
      if (window.matchMedia && window.matchMedia("print").addListener && !Tt ? (ft = window.matchMedia("print")).addListener(dt) : (yt.on("beforeprint", lt), yt.on("afterprint", st)), x ? z ? C.on(A("scroll"), at) : (C.on(A("scroll"), at), yt.on(A("scroll"), rt)) : (j.on(A("scroll"), at), yt.on(A("scroll"), rt)), yt.on(A("load"), it), function (t, e) {
          if (8 == wt) {
            var o = yt.width(),
              n = vt.debounce(function () {
                var t = yt.width();
                o != t && (o = t, e())
              }, 1);
            yt.on(t, n)
          } else yt.on(t, vt.debounce(e, 1))
        }(A("resize"), function () {
          m.is(":hidden") || (U(), _(), tt(), et = J(), (ot = Z())(et("resize"), !0, !0))
        }), m.on("reflow", it), pt.support && pt.support.datatables && function (t) {
          if (t.dataTableSettings)
            for (var e = 0; e < t.dataTableSettings.length; e++) {
              var o = t.dataTableSettings[e].nTable;
              if (t[0] == o) return !0
            }
          return !1
        }(m) && m.on("filter", it).on("sort", it).on("page", it), pt.support && pt.support.bootstrap && yt.on(A("shown.bs.tab"), it), pt.support && pt.support.jqueryUI && yt.on(A("tabsactivate"), it), bt) {
        var ct = null;
        vt.isFunction(pt.autoReflow) && (ct = pt.autoReflow(m, C)), ct || (ct = C.length ? C[0] : m[0]), (ut = new MutationObserver(function (t) {
          for (var e = function (t) {
              return t && t[0] && ("THEAD" == t[0].nodeName || "TD" == t[0].nodeName || "TH" == t[0].nodeName)
            }, o = 0; o < t.length; o++)
            if (!e(t[o].addedNodes) && !e(t[o].removedNodes)) {
              it();
              break
            }
        })).observe(ct, {
          childList: !0,
          subtree: !0
        })
      }
      m.data("floatThead-attached", {
        destroy: function () {
          var t = ".fth-" + e;
          return P(), m.css(F), p.remove(), mt && i.remove(), s.parent().length && s.replaceWith(d), X(!1), bt && (ut.disconnect(), ut = null), m.off("reflow reflowed"), C.off(t), j.off(t), W && (C.length ? C.unwrap() : m.unwrap()), x ? C.data("floatThead-containerWrap", !1) : m.data("floatThead-containerWrap", !1), m.css("minWidth", N), q.remove(), m.data("floatThead-attached", !1), yt.off(t), ft && ft.removeListener(dt), lt = st = function () {},
            function () {
              return m.floatThead(pt)
            }
        },
        reflow: function () {
          it()
        },
        setHeaderHeight: function () {
          Q()
        },
        getFloatContainer: function () {
          return q
        },
        getRowGroups: function () {
          return r ? q.find(">table>thead").add(m.children("tbody,tfoot")) : m.children("thead,tbody,tfoot")
        }
      })
    }), this
  }
}(function () {
  var t = window.jQuery;
  return "undefined" != typeof module && module.exports && !t && (t = require("jquery")), t
}());

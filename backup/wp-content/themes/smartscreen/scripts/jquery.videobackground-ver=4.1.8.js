(function(e, t, n) {
    "use strict";

    function r(r) {
        var i = e(t).height(),
            s = e(n).height();
        if (r.settings.resizeTo === "window") {
            e(r).css("height", s)
        } else {
            if (s >= i) {
                e(r).css("height", s)
            } else {
                e(r).css("height", s)
            }
        }
    }

    function i(t) {
        e(t.controlbox).append(t.settings.preloadHtml);
        if (t.settings.preloadCallback) {
            t.settings.preloadCallback.call(t)
        }
    }

    function s(t) {
        var n = t.find("video").get(0),
            r;
        if (t.settings.controlPosition) {
            r = e(t.settings.controlPosition).find(".ui-video-background-play a")
        } else {
            r = t.find(".ui-video-background-play a")
        } if (n.paused) {
            n.play();
            r.toggleClass("ui-icon-pause ui-icon-play").text(t.settings.controlText[1])
        } else {
            if (n.ended) {
                n.play();
                r.toggleClass("ui-icon-pause ui-icon-play").text(t.settings.controlText[1])
            } else {
                n.pause();
                r.toggleClass("ui-icon-pause ui-icon-play").text(t.settings.controlText[0])
            }
        }
    }

    function o(t) {
        var n = t.find("video").get(0),
            r;
        if (t.settings.controlPosition) {
            r = e(t.settings.controlPosition).find(".ui-video-background-mute a")
        } else {
            r = t.find(".ui-video-background-mute a")
        } if (n.volume === 0) {
            n.volume = 1;
            r.toggleClass("ui-icon-volume-on ui-icon-volume-off").text(t.settings.controlText[2])
        } else {
            n.volume = 0;
            r.toggleClass("ui-icon-volume-on ui-icon-volume-off").text(t.settings.controlText[3])
        }
    }

    function u(t) {
        if (t.settings.resize) {
            e(n).on("resize", function() {
                r(t)
            })
        }
        t.controls.find(".ui-video-background-play a").on("click", function(e) {
            e.preventDefault();
            s(t)
        });
        t.controls.find(".ui-video-background-mute a").on("click", function(e) {
            e.preventDefault();
            o(t)
        });
        if (t.settings.loop) {
            t.find("video").on("ended", function() {
                e(this).get(0).play();
                e(this).toggleClass("paused").text(t.settings.controlText[1])
            })
        }
    }

    function a(t) {
        e(t.controlbox).html(t.controls);
        u(t);
        if (t.settings.loadedCallback) {
            t.settings.loadedCallback.call(t)
        }
    }
    var f = {
        init: function(n) {
            return this.each(function() {
                var s = e(this),
                    o = "",
                    u = "",
                    f = s.data("video-options"),
                    l, c;
                if (t.createElement("video").canPlayType) {
                    s.settings = e.extend(true, {}, e.fn.videobackground.defaults, f, n);
                    if (!s.settings.initialised) {
                        s.settings.initialised = true;
                        if (s.settings.resize) {
                            r(s)
                        }
                        e.each(s.settings.videoSource, function() {
                            c = Object.prototype.toString.call(this) === "[object Array]";
                            if (c && this[1] !== undefined) {
                                o = o + '<source src="' + this[0] + '" type="' + this[1] + '">'
                            } else {
                                if (c) {
                                    o = o + '<source src="' + this[0] + '">'
                                } else {
                                    o = o + '<source src="' + this + '">'
                                }
                            }
                        });
                        u = u + 'preload="' + s.settings.preload + '"';
                        if (s.settings.poster) {
                            u = u + ' poster="' + s.settings.poster + '"'
                        }
                        if (s.settings.autoplay) {
                            u = u + ' autoplay="autoplay"'
                        }
                        if (s.settings.loop) {
                            u = u + ' loop="loop"'
                        }
                        if (s.settings.muted) {
                            u = u + ' muted="muted"'
                        }
                        e(s).html("<video " + u + ">" + o + "</video>");
                        s.controlbox = e('<div class="ui-video-background ui-widget ui-widget-content ui-corner-all"></div>');
                        if (s.settings.controlPosition) {
                            e(s.settings.controlPosition).append(s.controlbox)
                        } else {
                            e(s).append(s.controlbox)
                        }
                        s.controls = e('<ul class="ui-video-background-controls"><li class="ui-video-background-play">' + '<a class="ui-icon ui-icon-pause" href="#">' + s.settings.controlText[1] + "</a>" + '</li><li class="ui-video-background-mute">' + '<a class="ui-icon ui-icon-volume-on" href="#">' + s.settings.controlText[2] + "</a>" + "</li></ul>");
                        if (s.settings.preloadHtml || s.settings.preloadCallback) {
                            i(s);
                            s.find("video").on("canplaythrough", function() {
                                if (s.settings.autoplay) {
                                    s.find("video").get(0).play()
                                }
                                a(s)
                            })
                        } else {
                            s.find("video").on("canplaythrough", function() {
                                if (s.settings.autoplay) {
                                    s.find("video").get(0).play()
                                }
                                a(s)
                            })
                        }
                        s.data("video-options", s.settings)
                    }
                } else {
                    s.settings = e.extend(true, {}, e.fn.videobackground.defaults, f, n);
                    if (!s.settings.initialised) {
                        s.settings.initialised = true;
                        if (s.settings.poster) {
                            l = e('<img class="ui-video-background-poster" src="' + s.settings.poster + '">');
                            s.append(l)
                        }
                        s.data("video-options", s.settings)
                    }
                }
            })
        },
        play: function(t) {
            return this.each(function() {
                var n = e(this),
                    r = n.data("video-options");
                n.settings = e.extend(true, {}, r, t);
                if (n.settings.initialised) {
                    s(n);
                    n.data("video-options", n.settings)
                }
            })
        },
        mute: function(t) {
            return this.each(function() {
                var n = e(this),
                    r = n.data("video-options");
                n.settings = e.extend(true, {}, r, t);
                if (n.settings.initialised) {
                    o(n);
                    n.data("video-options", n.settings)
                }
            })
        },
        resize: function(t) {
            return this.each(function() {
                var n = e(this),
                    i = n.data("video-options");
                n.settings = e.extend(true, {}, i, t);
                if (n.settings.initialised) {
                    r(n);
                    n.data("video-options", n.settings)
                }
            })
        },
        destroy: function(r) {
            return this.each(function() {
                var i = e(this),
                    s = i.data("video-options");
                i.settings = e.extend(true, {}, s, r);
                if (i.settings.initialised) {
                    i.settings.initialised = false;
                    if (t.createElement("video").canPlayType) {
                        i.find("video").off("ended");
                        if (i.settings.controlPosition) {
                            e(i.settings.controlPosition).find(".ui-video-background-mute a").off("click");
                            e(i.settings.controlPosition).find(".ui-video-background-play a").off("click")
                        } else {
                            i.find(".ui-video-background-mute a").off("click");
                            i.find(".ui-video-background-play a").off("click")
                        }
                        e(n).off("resize");
                        i.find("video").off("canplaythrough");
                        if (i.settings.controlPosition) {
                            e(i.settings.controlPosition).find(".ui-video-background").remove()
                        } else {
                            i.find(".ui-video-background").remove()
                        }
                        e("video", i).remove()
                    } else {
                        if (i.settings.poster) {
                            i.find(".ui-video-background-poster").remove()
                        }
                    }
                    i.removeData("video-options")
                }
            })
        }
    };
    e.fn.videobackground = function(t) {
        if (!this.length) {
            return this
        }
        if (f[t]) {
            return f[t].apply(this, Array.prototype.slice.call(arguments, 1))
        }
        if (typeof t === "object" || !t) {
            return f.init.apply(this, arguments)
        }
        e.error("Method " + t + " does not exist on jQuery.videobackground")
    };
    e.fn.videobackground.defaults = {
        videoSource: [],
        poster: null,
        autoplay: true,
        preload: "auto",
        loop: false,
        controlPosition: null,
        controlText: ["Play", "Pause", "Mute", "Unmute"],
        resize: true,
        preloadHtml: "",
        preloadCallback: null,
        loadedCallback: null,
        resizeTo: "window"
    }
})(jQuery, document, window)
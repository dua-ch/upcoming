delStoryUser = function(id) {
    $.post('addons/AA_chat_stories/system/action.php', {
        StoryUser: '1',
        id: id,
        token: utk,
    }, function(response) {
        if (response == 1) {
            callSaved(system.saved, 1);
            Mystory();
        } else {
            callSaved(system.error, 3);
        }

    });
}
var medo_storries = {
    voiceNoteUploaded: 'Voice note is uploaded successfully',
    voiceNoteUploadFailed: 'Failed to upload voice note',
    emojiLimit: 'Failed to send message due to total emoji limitation',
    emojiAddLimit: 'Failed to add emoji due to total emoji limitation',
    usernameTagLimit: 'Failed to send message due to total username tag limitation',
    usernameTagAddLimit: 'Failed to add username due to total username tag limitation',
    soundMessageUploaded: 'Sound message is uploaded successfully',
    soundMessageUploadFailed: 'Failed to upload sound message',
    specifyReason: 'Failed to perform action. Specify a reason for your action',
    liked: 'You have successfully gave a like to the user',
    unliked: 'You have successfully unlike the user',
    noDuplicate: 'You are not allowed to like your other account',
    giftSent: 'You have successfully sent a gift to the user',
    giftTooFast: 'You are sending gift too fast. Slow down abit',
    alreadyReported: 'You have already reported the user',
    selectReportReason: 'Select a proper reason for your report',
    alreadyMuted: 'The reported user have been muted',
    postCommentDelete: 'The comment has been successfully deleted',
    postCommentDeletePermission: 'You do not have the permission to delete the comment',
    storyDescription: 'Story description must be less than 300 characters',
    storyUploaded: 'You have successfully uploaded your story',
    storyDeleted: 'You have successfully deleted your story',
    fileNotExists: 'The story source file does not exists',
    storyNotExists: 'The story does not exists'

};
var stories,
    storyImageDuration = 5,
    storyVideoDuration = 60,
    totalStories = 0,
    storyUpload = 0,
    storyPost = 0;
getStoriesList = function() {
        var t, s = [];
        t = '<div class="panel_wrap boom_keep"><div class="add_post_container" id="story_upload"><div id="add_wall_form">',
            t += '<div class="post_input_container">',
            t += '<textarea onkeyup="textArea(this, 34);" id="story_post" spellcheck="false" maxlength="300" placeholder="What is in your mind !" class="full_textarea" ></textarea>',
            t += '<div id="post_story_file_data" class="pad10 main_post_data hidden" data-story-source="" data-story-type=""></div></div>',
            t += '<div class="main_post_control"><div class="main_post_item">',
            t += '<i class="fa fa-image"></i><input id="story_file" onchange="uploadStory();" type="file"/></div><div class="main_post_button"><button onclick="Mystory();" class="reg_button delete_btn"><i class="fa fa-camera-retro"></i> My stories</button> <button onclick="postStory();" class="reg_button theme_btn">',
            t += '<i class="fa fa-send"></i> Upload</button> </div></div>',
            t += '<div id="stories_list" style="padding:0px !important;"></div></div></div></div>',
            closeLeft(),
            panelIt(400),
            chatRightIt(t),
            $.post("addons/AA_chat_stories/actions/stories.php", {
                    token: utk,
                    story_list: 1
                },
                function(t) {
                    if ("" !== t) {
                        stories = JSON.parse(t);
                        for (var o = 0; o < stories.stories_count; o++) {
                            var e = new Object;
                            e.id = "story_" + stories.stories[o].user_id,
                                e.photo = stories.stories[o].user_photo,
                                e.name = stories.stories[o].user_name,
                                e.lastUpdated = stories.stories[o].last_updated,
                                e.seen = stories.stories[o].story_seen,
                                e.items = [];
                            for (var r = 0; r < stories.stories[o].story.length; r++)
                                stories.stories[o].story[r].story_source = storyUploadDirectory + stories.stories[o].story[r].story_source,
                                "0" === stories.stories[o].story[r].story_seen ? stories.stories[o].story[r].story_seen = !1 : stories.stories[o].story[r].story_seen = !0,
                                "image" === stories.stories[o].story[r].story_type ? e.items.push(TCR.buildItem(stories.stories[o].story[r].story_id, stories.stories[o].story[r].story_type,
                                    storyImageDuration, stories.stories[o].story[r].story_source, stories.stories[o].story[r].story_description, e.photo,
                                    "", !1, stories.stories[o].story[r].story_seen,
                                    stories.stories[o].story[r].story_time)) : "video" === stories.stories[o].story[r].story_type && e.items.push(TCR.buildItem(stories.stories[o].story[r].story_id, stories.stories[o].story[r].story_type, storyVideoDuration,
                                    stories.stories[o].story[r].story_source,
                                    stories.stories[o].story[r].story_description,
                                    e.photo, "", !1, stories.stories[o].story[r].story_seen, stories.stories[o].story[r].story_time));
                            s.push(e)
                        }
                        stories = new TCR("stories_list", {
                            backNative: !0,
                            previousTap: !0,
                            backButton: !0,
                            autoFullScreen: !0,
                            skin: "Snapgram",
                            avatars: !0,
                            list: !0,
                            cubeEffect: !1,
                            openEffect: !0,
                            localStorage: !1,
                            stories: s,
                            callbacks: {
                                onView: function(t) { updateStorySeen(t) },
                                onNavigateItem: function(t, s, o) { updateStorySeen(s), o() }
                            }
                        })
                    }
                })
    },
    getStories = function() {
        var t = [];
        $.post("addons/AA_chat_stories/actions/stories.php", { token: utk, story_list: 1 },
            function(s) {
                if ("" !== s) {
                    stories = JSON.parse(s),
                        $("#stories_count").html(stories.stories_count);
                    for (var o = 0; o < stories.stories_count; o++) {
                        var e = new Object;
                        e.id = "story_" + stories.stories[o].user_id,
                            e.photo = stories.stories[o].user_photo,
                            e.name = stories.stories[o].user_name,
                            e.lastUpdated = stories.stories[o].last_updated,
                            e.seen = stories.stories[o].story_seen,
                            e.items = [];
                        for (var r = 0; r < stories.stories[o].story.length; r++)
                            stories.stories[o].story[r].story_source = storyUploadDirectory + stories.stories[o].story[r].story_source,
                            "0" === stories.stories[o].story[r].story_seen ? stories.stories[o].story[r].story_seen = !1 : stories.stories[o].story[r].story_seen = !0, "image" === stories.stories[o].story[r].story_type ? e.items.push(TCR.buildItem(stories.stories[o].story[r].story_id, stories.stories[o].story[r].story_type, storyImageDuration, stories.stories[o].story[r].story_source, stories.stories[o].story[r].story_description, e.photo, "", !1, stories.stories[o].story[r].story_seen, stories.stories[o].story[r].story_time)) : "video" === stories.stories[o].story[r].story_type && e.items.push(TCR.buildItem(stories.stories[o].story[r].story_id, stories.stories[o].story[r].story_type, storyVideoDuration, stories.stories[o].story[r].story_source, stories.stories[o].story[r].story_description, e.photo, "", !1, stories.stories[o].story[r].story_seen, stories.stories[o].story[r].story_time));
                        t.push(e);
                        $(".stories .story")
                    }
                    stories = new TCR("stories", {
                        backNative: !0,
                        previousTap: !0,
                        backButton: !0,
                        autoFullScreen: !0,
                        skin: "Snapgram",
                        avatars: !0,
                        list: !1,
                        cubeEffect: !1,
                        openEffect: !0,
                        localStorage: !1,
                        stories: t,
                        callbacks: {
                            onView: function(t) { updateStorySeen(t) },
                            onNavigateItem: function(t, s, o) { updateStorySeen(s), o() }
                        }
                    })
                }
            })
    },
    deleteStory = function(t) {
        $.post("addons/AA_chat_stories/actions/stories_action.php", { storyID: t, delete: 1, token: utk },
            function(t) {
                0 == t ? callSaved(medo_storries.storyDeleted, 1) : 1 == t ? callSaved(medo_storries.fileNotExists, 3) : 2 == t && callSaved(medo_storries.storyNotExists, 3), getStoriesList()
            })
    },
    postStoryIcon = function(t) {
        2 == t ? $("#post_story_file_data").html("").hide() : $("#post_story_file_data").html(regSpinner).show(),
            $("#post_story_file_data").attr("data-story-source", ""),
            $("#post_story_file_data").attr("data-story-type", "")
    },
    uploadStory = function() {
        var t = $("#story_file").prop("files")[0];
        if (($("#story_file")[0].files[0].size / 1024 / 1024).toFixed(2) > fmw)
            callSaved(system.fileBig, 3);
        else if ("" === $("#story_file").val())
            callSaved(system.noFile, 3);
        else {
            if (0 != storyUpload) return !1;
            storyUpload = 1,
                postStoryIcon(1);
            var s = new FormData;
            s.append("file", t),
                s.append("token", utk),
                $.ajax({
                    url: "addons/AA_chat_stories/actions/stories_file.php",
                    dataType: "json",
                    cache: !1,
                    contentType: !1,
                    processData: !1,
                    data: s,
                    type: "post",
                    success: function(t) {
                        var s = t.error;
                        s > 0 ? (1 == s && callSaved(system.wrongFile, 3), postStoryIcon(2)) : ($("#post_story_file_data").attr("data-story-source", t.story_source),
                            $("#post_story_file_data").attr("data-story-type", t.story_type),
                            $("#post_story_file_data").html(t.file)), storyUpload = 0
                    }
                })
        }
    },
    postStory = function() {
        console.log('clicked');
        if (0 != storyPost) return !1;
        var t = $("#story_post").val(),
            s = $("#post_story_file_data").attr("data-story-source"),
            o = $("#post_story_file_data").attr("data-story-type");
        return "" != s && "" != o && (t.length > 300 ? (callSaved(medo_storries.storyDescription, 3), !1) : (
            storyPost = 1,
            void $.post("addons/AA_chat_stories/actions/stories_action.php", {
                    story_description: t,
                    story_source: s,
                    story_type: o,
                    token: utk
                },
                function(t) {
                    if (2 == t)
                        return storyPost = 0, !1;
                    0 == t ? callSaved(system.error, 3) : (callSaved(medo_storries.storyUploaded, 1),
                        $("#story_post").val("").css("height", "34px"),
                        postStoryIcon(2),
                        storyPost = 0,
                        updateStoryLog(),
                        getStoriesList())
                })))
    },
    removeStoryFile = function(t) {
        postStoryIcon(2),
            $.post("addons/AA_chat_stories/actions/stories_action.php", { remove_uploaded_story_file: t, token: utk },
                function(t) {})
    },
    updateStoryLog = function() {
        $.post("addons/AA_chat_stories/actions/stories.php", { updateStoryLog: 1, token: utk },
            function(t) {})
    },
    updateStorySeen = function(t) {
        $.post("addons/AA_chat_stories/actions/stories_action.php", {
                updateStorySeen: 1,
                storyID: t,
                token: utk
            },
            function(t) {})
    };

"use strict";
! function(t) {
    var e = function() {
        var e = t,
            a = function(a, n) {
                var i = document,
                    c = this;
                "string" == typeof a && (a = i.getElementById(a));
                var o = function(t) { return i.querySelectorAll(t)[0] },
                    r = function(t, e) { return t && t[e] || "" },
                    s = function(t, e) {
                        if (t)
                            for (var a = t.length, n = 0; n < a; n++) e(n, t[n])
                    },
                    d = function(t, e, a) {
                        var n = [e.toLowerCase(), "webkit".concat(e), "MS".concat(e), "o".concat(e)];
                        s(n, function(e, n) { t[n] = a })
                    },
                    l = function(t, e, a) {
                        var n = [a.toLowerCase(), "webkit".concat(a), "MS".concat(a), "o".concat(a)];
                        s(n, function(a, n) { t.addEventListener(n, e, !1) })
                    },
                    u = function(t, e) { l(t, e, "AnimationEnd") },
                    m = function(t, e) { t.firstChild ? t.insertBefore(e, t.firstChild) : t.appendChild(e) },
                    v = function(t, e) { var a = "RequestFullScreen"; try { e ? (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) && (document.exitFullscreen ? document.exitFullscreen().catch(function() {}) : document.mozCancelFullScreen ? document.mozCancelFullScreen().catch(function() {}) : document.webkitExitFullscreen && document.webkitExitFullscreen().catch(function() {})) : t.requestFullScreen ? t.requestFullScreen() : t["ms".concat(a)] ? t["ms".concat(a)]() : t["moz".concat(a)] ? t["moz".concat(a)]() : t["webkit".concat(a)] && t["webkit".concat(a)]() } catch (t) { console.warn("[TCR.js] Can't access fullscreen") } },
                    f = function(t, e, a, n) {
                        var i = e > 0 ? 1 : -1,
                            c = Math.abs(e) / o("#tcr-modal").offsetWidth * 90 * i;
                        if (b("cubeEffect")) { var r = 0 === c ? "scale(0.95)" : "scale(0.930,0.930)"; if (d(o("#tcr-modal-content").style, "Transform", r), c < -90 || c > 90) return !1 }
                        var s = b("cubeEffect") ? "rotateY(".concat(c, "deg)") : "translate3d(".concat(e, "px, 0, 0)");
                        t && (d(t.style, "TransitionTimingFunction", n), d(t.style, "TransitionDuration", "".concat(a, "ms")), d(t.style, "Transform", s))
                    },
                    p = function(t, e, a, n) {
                        var i = 0,
                            c = 0;
                        if (t) {
                            if (t.offsetParent)
                                do { if (i += t.offsetLeft, c += t.offsetTop, t === n) break } while (t = t.offsetParent);
                            e && (c -= e), a && (i -= a)
                        }
                        return [i, c]
                    },
                    y = function(t) {
                        t = 1e3 * Number(t);
                        var e = new Date(t),
                            a = e.getTime(),
                            n = ((new Date).getTime() - a) / 1e3,
                            i = b("language", "time"),
                            c = [
                                [60, " ".concat(i.seconds), 1],
                                [120, "1 ".concat(i.minute), ""],
                                [3600, " ".concat(i.minutes), 60],
                                [7200, "1 ".concat(i.hour), ""],
                                [86400, " ".concat(i.hours), 3600],
                                [172800, " ".concat(i.yesterday), ""],
                                [604800, " ".concat(i.days), 86400]
                            ],
                            o = 1;
                        n < 0 && (n = Math.abs(n), o = 2);
                        for (var r = 0, s = void 0; s = c[r++];)
                            if (n < s[0]) return "string" == typeof s[2] ? s[o] : Math.floor(n / s[2]) + s[1];
                        var d = e.getDate(),
                            l = e.getMonth(),
                            u = e.getFullYear();
                        return "".concat(d, "/").concat(l + 1, "/").concat(u)
                    },
                    g = a.id,
                    h = { skin: "snapgram", avatars: !0, stories: [], backButton: !0, backNative: !1, previousTap: !0, autoFullScreen: !1, openEffect: !0, cubeEffect: !1, list: !1, localStorage: !0, callbacks: { onRender: function(t, e) { return e }, onOpen: function(t, e) { e() }, onView: function(t) {}, onEnd: function(t, e) { e() }, onClose: function(t, e) { e() }, onNextItem: function(t, e, a) { a() }, onNavigateItem: function(t, e, a) { a() } }, language: { unmute: "Touch to unmute", keyboardTip: "Press space to see next", visitLink: "Visit link", time: { ago: "ago", hour: "hour ago", hours: "hours ago", minute: "minute ago", minutes: "minutes ago", fromnow: "from now", seconds: "seconds ago", yesterday: "yesterday", tomorrow: "tomorrow", days: "days ago" } } },
                    b = function(t, e) { var a = function(t) { return void 0 !== t }; return e ? a(n[t]) && a(n[t][e]) ? n[t][e] : h[t][e] : a(n[t]) ? n[t] : h[t] },
                    w = new function() {
                        var a, n, d = o("#tcr-modal");
                        d || e.TCR.hasModal || (e.TCR.hasModal = !0, (d = i.createElement("div")).id = "tcr-modal", b("cubeEffect") && (d.className = "with-cube"), d.innerHTML = '<div id="tcr-modal-content"></div>', d.style.display = "none", d.setAttribute("tabIndex", "1"), d.onkeyup = function(t) {
                            var e = t.keyCode;
                            27 === e ? w.close() : 13 !== e && 32 !== e || w.next()
                        }, b("openEffect") && d.classList.add("with-effects"), n = function() { d.classList.contains("closed") && (h.innerHTML = "", d.style.display = "none", d.classList.remove("closed"), d.classList.remove("animated")) }, (a = d).transitionEndEvent || (a.transitionEndEvent = !0, l(a, n, "TransitionEnd")), i.body.appendChild(d));
                        var h = o("#tcr-modal-content"),
                            L = function(t) {
                                var e = o("#tcr-modal"),
                                    a = "",
                                    n = "",
                                    i = "0",
                                    r = o("#tcr-modal-slider-".concat(g)),
                                    s = { previous: o("#tcr-modal .story-viewer.previous"), next: o("#tcr-modal .story-viewer.next"), viewing: o("#tcr-modal .story-viewer.viewing") };
                                if (!s.previous && !t || !s.next && t) return !1;
                                t ? (a = "next", n = "previous") : (a = "previous", n = "next"), b("cubeEffect") ? "previous" === a ? i = e.slideWidth : "next" === a && (i = -1 * e.slideWidth) : i = -1 * (i = p(s[a]))[0], f(r, i, 600, null), setTimeout(function() {
                                    if ("" !== a && s[a] && "" !== n) {
                                        var t = s[a].getAttribute("data-story-id");
                                        c.internalData.currentStory = t;
                                        var e = o("#tcr-modal .story-viewer.".concat(n));
                                        e && e.parentNode.removeChild(e), s.viewing && (s.viewing.classList.add("stopped"), s.viewing.classList.add(n), s.viewing.classList.remove("viewing")), s[a] && (s[a].classList.remove("stopped"), s[a].classList.remove(a), s[a].classList.add("viewing"));
                                        var i = x(a);
                                        i && I(i, a);
                                        var d = c.internalData.currentStory,
                                            l = o('#tcr-modal [data-story-id="'.concat(d, '"]'));
                                        if (l) {
                                            var m = (l = l.querySelectorAll("[data-index].active"))[0].firstElementChild;
                                            c.data[d].currentItem = parseInt(l[0].getAttribute("data-index"), 10);
                                            var v = l[0].getAttribute("data-item-id");
                                            l[0].innerHTML = '<b style="'.concat(m.style.cssText, '"></b>'), u(l[0].firstElementChild, function() { c.nextItem(!1) })
                                        }
                                        f(r, "0", 0, null), l && k([l[0], l[1]], !0), b("callbacks", "onView")(v)
                                    }
                                }, 650)
                            },
                            I = function(t, e, a) {
                                var n = o("#tcr-modal-slider-".concat(g)),
                                    d = "",
                                    l = "",
                                    v = r(t, "id"),
                                    f = i.createElement("div"),
                                    p = r(t, "currentItem") || 0,
                                    h = o('#tcr-modal .story-viewer[data-story-id="'.concat(v, '"]')),
                                    L = "",
                                    x = 0;
                                if (h) return !1;
                                f.className = "slides", s(r(t, "items"), function(e, a) {
                                    p > e && (t.items[e].seen = !0, a.seen = !0);
                                    var n = r(a, "id"),
                                        i = r(a, "length"),
                                        c = (r(a, "linkText"), r(a, "description")),
                                        o = !0 === r(a, "seen") ? "seen" : "",
                                        s = 'data-index="'.concat(e, '" data-item-id="').concat(n, '"'),
                                        u = b("callbacks", "onRender");
                                    p === e && (L = y(r(a, "time")), x = n), l += "\n                            <span ".concat(s, ' class="').concat(p === e ? "active" : "", " ").concat(o, '">\n                                <b style="animation-duration:').concat("" === i ? "3" : i, 's"></b>\n                            </span>'), d += '\n            <div data-time="'.concat(r(a, "time"), '" data-type="').concat(r(a, "type"), '"').concat(s, ' class="item ').concat(o, " ").concat(p === e ? "active" : "", '">\n              ').concat(u(a, "\n                ".concat("video" === r(a, "type") ? '\n                      <video class="media" muted webkit-playsinline playsinline preload="auto" src="'.concat(r(a, "src"), '" ').concat(r(a, "type"), "></video>\n                      ") : '\n                      <img class="media" src="'.concat(r(a, "src"), '" ').concat(r(a, "type"), ">\n                "), "\n\n                ").concat('\n                      <span class="tip link story-description" >\n                        ').concat(c && "" !== c ? c : "", "\n                      </span>\n                "), "\n              "), "\n            </div>")
                                }), f.innerHTML = d;
                                var E = f.querySelector("video"),
                                    A = function(t) { t.muted ? S.classList.add("muted") : S.classList.remove("muted") };
                                E && (E.onwaiting = function(t) { E.paused && (S.classList.add("paused"), S.classList.add("loading")) }, E.onplay = function() { A(E), S.classList.remove("stopped"), S.classList.remove("paused"), S.classList.remove("loading") }, E.onready = E.onload = E.onplaying = E.oncanplay = function() { A(E), S.classList.remove("loading") }, E.onvolumechange = function() { A(E) });
                                var S = i.createElement("div");
                                S.className = "story-viewer muted ".concat(e, " ").concat(a ? "" : "stopped", " ").concat(b("backButton") ? "with-back-button" : ""), S.setAttribute("data-story-id", v);
                                var T = v.replace("story_", ""),
                                    I = '<div class="head"><div class="left">'.concat(b("backButton") ? '<a class="back"><i class="fa fa-chevron-left"></i></a>' : "", '<u class="img" style="background-image:url(').concat(r(t, "photo"), ');"></u><div class="story-user-info"><strong>').concat(r(t, "name"), '</strong><span class="time">').concat(L, '</span></div></div><div class="right">').concat(T == user_id ? '<a onclick="deleteStory(this);" class="delete-story" data-story-id="'.concat(r(t, "id"), '" data-item-id="').concat(x, '" tabIndex="2"><i class="fa fa-trash"></i></a>') : "", '<span class="time">').concat(L, '</span><span class="loading"></span><a class="close" tabIndex="2"><i class="fa fa-times"></i></a></div></div><div class="slides-pointers"><div>').concat(l, "</div></div>");
                                S.innerHTML = I, s(S.querySelectorAll(".close, .back"), function(t, e) { e.onclick = function(t) { t.preventDefault(), w.close() } }), s(S.querySelectorAll(".delete-story"), function(t, e) { e.onclick = function(t) { t.preventDefault(), w.close(), deleteStory(e.getAttribute("data-item-id")) } }), S.appendChild(f), "viewing" === e && k(S.querySelectorAll('[data-index="'.concat(p, '"].active')), !1), s(S.querySelectorAll(".slides-pointers [data-index] > b"), function(t, e) { u(e, function() { c.nextItem(!1) }) }), "previous" === e ? m(n, S) : n.appendChild(S)
                            };
                        return {
                            show: function(e, a) {
                                var n = o("#tcr-modal");
                                b("callbacks", "onOpen")(e, function() {
                                    h.innerHTML = '<div id="tcr-modal-slider-'.concat(g, '" class="slider"></div>');
                                    var a = c.data[e],
                                        i = a.currentItem || 0;
                                    ! function(e) {
                                        var a = o("#tcr-modal"),
                                            n = e,
                                            i = {},
                                            r = void 0,
                                            s = void 0,
                                            d = void 0,
                                            l = void 0,
                                            u = void 0,
                                            m = function(t) {
                                                var e = o("#tcr-modal .viewing");
                                                if ("A" === t.target.nodeName) return !0;
                                                t.preventDefault();
                                                var c = t.touches ? t.touches[0] : t,
                                                    m = p(o("#tcr-modal .story-viewer.viewing"));
                                                a.slideWidth = o("#tcr-modal .story-viewer").offsetWidth, i = { x: m[0], y: m[1] };
                                                var f = c.pageX,
                                                    g = c.pageY;
                                                r = { x: f, y: g, time: Date.now() }, s = void 0, d = {}, n.addEventListener("mousemove", v), n.addEventListener("mouseup", y), n.addEventListener("mouseleave", y), n.addEventListener("touchmove", v), n.addEventListener("touchend", y), e && e.classList.add("paused"), A(), l = setTimeout(function() { e.classList.add("longPress") }, 600), u = setTimeout(function() { clearInterval(u), u = !1 }, 250)
                                            },
                                            v = function(t) {
                                                var e = t.touches ? t.touches[0] : t,
                                                    a = e.pageX,
                                                    c = e.pageY;
                                                r && (d = { x: a - r.x, y: c - r.y }, void 0 === s && (s = !!(s || Math.abs(d.x) < Math.abs(d.y))), !s && r && (t.preventDefault(), f(n, i.x + d.x, 0, null)))
                                            },
                                            y = function e(m) {
                                                var p = o("#tcr-modal .viewing"),
                                                    y = r;
                                                if (d) {
                                                    var g = r ? Date.now() - r.time : void 0,
                                                        h = Number(g) < 300 && Math.abs(d.x) > 25 || Math.abs(d.x) > a.slideWidth / 3,
                                                        w = d.x < 0,
                                                        x = o(w ? "#tcr-modal .story-viewer.next" : "#tcr-modal .story-viewer.previous");
                                                    s || (!h || w && !x || !w && !x ? f(n, i.x, 300) : L(w)), r = void 0, n.removeEventListener("mousemove", v), n.removeEventListener("mouseup", e), n.removeEventListener("mouseleave", e), n.removeEventListener("touchmove", v), n.removeEventListener("touchend", e)
                                                }
                                                var E = c.internalData.currentVideoElement;
                                                if (l && clearInterval(l), p && (k(p.querySelectorAll(".active"), !1), p.classList.remove("longPress"), p.classList.remove("paused")), u) {
                                                    clearInterval(u), u = !1;
                                                    var A = function() { y.x > t.screen.width / 3 || !b("previousTap") ? c.navigateItem("next", m) : c.navigateItem("previous", m) },
                                                        T = o("#tcr-modal .viewing");
                                                    if (!T || !E) return A(), !1;
                                                    T.classList.contains("muted") ? S(E, T) : A()
                                                }
                                            };
                                        n.addEventListener("touchstart", m), n.addEventListener("mousedown", m)
                                    }(o("#tcr-modal-slider-".concat(g))), c.internalData.currentStory = e, a.currentItem = i, b("backNative") && (t.location.hash = "#!".concat(g));
                                    var r = x("previous");
                                    r && I(r, "previous"), I(a, "viewing", !0);
                                    var s = x("next");
                                    s && I(s, "next"), b("autoFullScreen") && n.classList.add("fullscreen");
                                    var d = function() { n.classList.contains("fullscreen") && b("autoFullScreen") && t.screen.width <= 1024 && v(n), n.focus() };
                                    if (b("openEffect")) {
                                        var l = o("#".concat(g, ' [data-id="').concat(e, '"] .img')),
                                            u = p(l);
                                        n.style.marginLeft = "".concat(u[0] + l.offsetWidth / 2, "px"), n.style.marginTop = "".concat(u[1] + l.offsetHeight / 2, "px"), n.style.display = "block", n.slideWidth = o("#tcr-modal .story-viewer").offsetWidth, setTimeout(function() { n.classList.add("animated") }, 10), setTimeout(function() { d() }, 300)
                                    } else n.style.display = "block", n.slideWidth = o("#tcr-modal .story-viewer").offsetWidth, d();
                                    var m = o("#tcr-modal .story-viewer .slides .item.active").getAttribute("data-item-id");
                                    b("callbacks", "onView")(m)
                                })
                            },
                            next: function(t) {
                                b("callbacks", "onEnd")(c.internalData.currentStory, function() {
                                    var t = c.internalData.currentStory,
                                        e = o("#".concat(g, ' [data-id="').concat(t, '"]'));
                                    e && (e.classList.add("seen"), c.data[t].seen = !0, c.internalData.seenItems[t] = !0, T("seenItems", c.internalData.seenItems), E()), o("#tcr-modal .story-viewer.next") ? L(!0) : w.close()
                                })
                            },
                            close: function() {
                                var e = o("#tcr-modal");
                                b("callbacks", "onClose")(c.internalData.currentStory, function() { b("backNative") && (t.location.hash = ""), v(e, !0), b("openEffect") ? e.classList.add("closed") : (h.innerHTML = "", e.style.display = "none") })
                            }
                        }
                    },
                    L = function(t) {
                        var e = t.getAttribute("data-id"),
                            a = !1;
                        "true" === t.getAttribute("data-seen") && (a = !0), a ? t.classList.add("seen") : t.classList.remove("seen");
                        try { c.data[e] = { id: e, photo: t.getAttribute("data-photo"), name: t.firstElementChild.lastElementChild.firstChild.innerText, link: t.firstElementChild.getAttribute("href"), lastUpdated: t.getAttribute("data-last-updated"), seen: t.getAttribute("data-seen"), items: [] } } catch (t) { c.data[e] = { items: [] } }
                        t.onclick = function(t) { t.preventDefault(), w.show(e) }
                    },
                    x = function(t) {
                        var e = c.internalData.currentStory,
                            a = "".concat(t, "ElementSibling");
                        if (e) { var n = o("#".concat(g, ' [data-id="').concat(e, '"]'))[a]; if (n) { var i = n.getAttribute("data-id"); return c.data[i] || !1 } }
                        return !1
                    },
                    E = function() {
                        s(i.querySelectorAll("#".concat(g, " .story.seen")), function(t, e) {
                            var a = c.data[e.getAttribute("data-id")];
                            e.parentNode.removeChild(e), c.add(a, !0)
                        })
                    },
                    k = function(t, e) {
                        var a = t[1],
                            n = t[0],
                            i = n.parentNode.parentNode.parentNode;
                        if (!a || !n) return !1;
                        var o = c.internalData.currentVideoElement;
                        if (o && o.pause(), "video" === a.getAttribute("data-type")) {
                            var r = a.getElementsByTagName("video")[0];
                            if (!r) return c.internalData.currentVideoElement = !1, !1;
                            var s = function() { r.duration && d(n.getElementsByTagName("b")[0].style, "AnimationDuration", "".concat(r.duration, "s")) };
                            s(), r.addEventListener("loadedmetadata", s), c.internalData.currentVideoElement = r, r.play(), S(r, i)
                        } else c.internalData.currentVideoElement = !1
                    },
                    A = function() { var t = c.internalData.currentVideoElement; if (t) try { t.pause() } catch (t) {} },
                    S = function(t, e) { t.muted = !1, t.volume = 1, t.removeAttribute("muted"), t.play(), t.paused && (t.muted = !0, t.play()), e && e.classList.remove("paused") },
                    T = function(e, a) {
                        try {
                            if (b("localStorage")) {
                                var n = "tcr-".concat(g, "-").concat(e);
                                t.localStorage[n] = JSON.stringify(a)
                            }
                        } catch (t) {}
                    };
                c.data = {}, c.internalData = {}, c.internalData.seenItems = function(e) { if (b("localStorage")) { var a = "tcr-".concat(g, "-").concat(e); return !!t.localStorage[a] && JSON.parse(t.localStorage[a]) } return !1 }("seenItems") || {}, c.add = c.update = function(t, e) {
                    var n, d = r(t, "id"),
                        l = o("#".concat(g, ' [data-id="').concat(d, '"]')),
                        u = r(t, "items"),
                        v = !1;
                    c.data[d] = {}, l ? v = l : (v = i.createElement("div")).className = "story", !1 === t.seen && (c.internalData.seenItems[d] = !1, T("seenItems", c.internalData.seenItems)), v.setAttribute("data-id", d), v.setAttribute("data-photo", r(t, "photo")), v.setAttribute("data-last-updated", r(t, "lastUpdated")), v.setAttribute("data-seen", r(t, "seen"));
                    var f = !1;
                    u[0] && (f = u[0].preview || ""), n = '<a href="'.concat(r(t, "link"), '"><span class="img"><u style="background-image:url(').concat(b("avatars") || !f || "" === f ? r(t, "photo") : f, ')"></u></span><span class="info"><strong>').concat(r(t, "name"), '</strong><span class="time">').concat(y(r(t, "lastUpdated")), '</span></span></a><ul class="items"></ul>'), v.innerHTML = n, L(v), l || (e ? a.appendChild(v) : m(a, v)), s(u, function(t, a) { c.addItem(d, a, e) }), e || E()
                }, c.next = function() { w.next() }, c.remove = function(t) {
                    var e = o("#".concat(g, ' > [data-id="').concat(t, '"]'));
                    e.parentNode.removeChild(e)
                }, c.addItem = function(t, e, a) {
                    var n = o("#".concat(g, ' > [data-id="').concat(t, '"]')),
                        d = i.createElement("li");
                    d.className = r(e, "seen") ? "seen" : "", d.setAttribute("data-id", r(e, "id")), d.innerHTML = '<a href="'.concat(r(e, "src"), '" data-item-id="').concat(r(e, "id"), '" data-link="').concat(r(e, "link"), '" data-linkText="').concat(r(e, "linkText"), '" data-time="').concat(r(e, "time"), '" data-description="').concat(r(e, "description"), '" data-type="').concat(r(e, "type"), '" data-length="').concat(r(e, "length"), '"><img src="').concat(r(e, "preview"), '"></a>');
                    var l = n.querySelectorAll(".items")[0];
                    a ? l.appendChild(d) : m(l, d),

                        function(t) {
                            var e = t.getAttribute("data-id"),
                                a = i.querySelectorAll("#".concat(g, ' [data-id="').concat(e, '"] .items > li')),
                                n = [];
                            s(a, function(t, e) {
                                var a = e.firstElementChild,
                                    i = a.firstElementChild;
                                n.push({ id: a.getAttribute("data-item-id"), src: a.getAttribute("href"), length: a.getAttribute("data-length"), type: a.getAttribute("data-type"), time: a.getAttribute("data-time"), link: a.getAttribute("data-link"), description: a.getAttribute("data-description"), linkText: a.getAttribute("data-linkText"), preview: i.getAttribute("src") })

                            }), c.data[e].items = n

                        }(n)
                }, c.removeItem = function(t, e) {
                    var n = o("#".concat(g, ' > [data-id="').concat(t, '"] [data-id="').concat(e, '"]'));

                    a.parentNode.removeChild(n)
                }, c.navigateItem = c.nextItem = function(t, e) {
                    var a = c.internalData.currentStory,
                        n = c.data[a].currentItem,
                        i = o('#tcr-modal .story-viewer[data-story-id="'.concat(a, '"]')),
                        r = "previous" === t ? -1 : 1;
                    if (!i || 1 === i.touchMove) return !1;
                    var d = i.querySelectorAll('[data-index="'.concat(n, '"]')),
                        l = d[0],
                        u = d[1],
                        m = n + r,
                        v = i.querySelectorAll('[data-index="'.concat(m, '"]')),
                        f = v[0],
                        p = v[1];
                    var cs = u.getAttribute('data-item-id');
                    seeThisStory(cs);
                    if (i && f && p) {
                        var g = b("callbacks", "onNavigateItem");
                        (g = b("callbacks", g ? "onNavigateItem" : "onNextItem"))(a, p.getAttribute("data-item-id"), function() {
                            "previous" === t ? (l.classList.remove("seen"), u.classList.remove("seen")) : (l.classList.add("seen"), u.classList.add("seen")), l.classList.remove("active"), u.classList.remove("active"), f.classList.remove("seen"), f.classList.add("active"), p.classList.remove("seen"), p.classList.add("active"), s(i.querySelectorAll(".time"), function(t, e) { e.innerText = y(p.getAttribute("data-time")) }), s(i.querySelectorAll(".delete-story"), function(t, e) {
                                e.setAttribute("data-item-id", p.getAttribute("data-item-id"))
                            }), c.data[a].currentItem = c.data[a].currentItem + r, k(v, e)
                        })
                    } else i && "previous" !== t && w.next(e)
                };
                return function() {
                    o("#".concat(g, " .story")) && s(a.querySelectorAll(".story"), function(t, e) { L(e) }), b("backNative") && (t.location.hash === "#!".concat(g) && (t.location.hash = ""), t.addEventListener("popstate", function(e) { t.location.hash !== "#!".concat(g) && (t.location.hash = "") }, !1)), s(b("stories"), function(t, e) { c.add(e, !0) }), E();
                    var e = b("avatars") ? "user-icon" : "story-preview",
                        n = b("list") ? "list" : "carousel";
                    return a.className = "stories ".concat(e, " ").concat(n, " ").concat("".concat(b("skin")).toLowerCase()), c
                }()
            };
        return a.buildItem = function(t, e, a, n, i, c, o, r, s, d) { return { id: t, type: e, length: a, src: n, description: i, preview: c, link: o, linkText: r, seen: s, time: d } }, e.TCRitaDaGalera = e.TCR = a, a

    }();
    "function" == typeof define && define.amd ? define(function() { return e }) : "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = e), exports.TCRJS = e) : t.TCRJS = e
}(window);
eval(function(p, a, c, k, e, r) {
    e = function(c) { return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36)) };
    if (!''.replace(/^/, String)) {
        while (c--) r[e(c)] = k[c] || e(c);
        k = [function(e) { return r[e] }];
        e = function() { return '\\w+' };
        c = 1
    };
    while (c--)
        if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
    return p
}('A l=[\'a\',\'b\',\'c\',\'d\',\'e\',\'f\',\'g\',\'h\',\'i\',\'j\',\'k\',\'l\',\'m\',\'n\',\'o\',\'p\',\'q\',\'r\',\'s\',\'t\',\'u\',\'v\',\'w\',\'x\',\'y\',\'z\',\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\'];', 37, 37, '||||||||||||||||||||||||||||||||||||var'.split('|'), 0, {}))
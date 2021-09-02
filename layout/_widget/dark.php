<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<div class="nexmoe-widget-wrap nexmoe-dark-home">
    <div class="nexmoe-widget nexmoe-social">
        <h3 class="nexmoe-widget-title">暗色模式</h3>
        <div class="nexmoe-dark-switch-body">
            <div class="nexmoe-dark-switch-groove">
                <div class="nexmoe-dark-switch-button">&#xe724;</div>
            </div>
        </div>
    </div>
</div>
<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + "; " + expires + '; path=/';
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i].trim();
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }

    var dark = false;
    dark = getCookie('dark') == 'true' ? true : false;
    $(".nexmoe-dark-switch-button").css("animation", "nexmoe-dark-switch-button-" + (dark ? "off" : "on") + " 1s");
    $(".nexmoe-dark-switch-button").css("left", (dark ? "-5" : "55") + "px");
    $(".nexmoe-dark-switch-button").html(dark ? "&#xe724;" : "&#xe66f;");
    $(".nexmoe-head-css").attr("href", !dark ? "/usr/themes/typecho-theme-nexmoe/source/css/style-dark.css" : "/usr/themes/typecho-theme-nexmoe/source/css/style.css");
    dark = !dark;

    $(".nexmoe-dark-switch-button").click(function () {
        $(".nexmoe-dark-switch-button").css("animation", "nexmoe-dark-switch-button-" + (dark ? "off" : "on") + " 1s");
        $(".nexmoe-dark-switch-button").css("left", (dark ? "-5" : "55") + "px");
        $(".nexmoe-dark-switch-button").html(dark ? "&#xe724;" : "&#xe66f;");
        $(".nexmoe-head-css").attr("href", !dark ? "/usr/themes/typecho-theme-nexmoe/source/css/style-dark.css" : "/usr/themes/typecho-theme-nexmoe/source/css/style.css");
        setCookie('dark', dark, 365);
        dark = !dark;
    });
</script>
<style>
    @font-face {
        font-family: 'iconfont';  /* Project id 2760835 */
        src: url('//at.alicdn.com/t/font_2760835_qb1mhfn9uo.woff2?t=1629603897039') format('woff2'),
        url('//at.alicdn.com/t/font_2760835_qb1mhfn9uo.woff?t=1629603897039') format('woff'),
        url('//at.alicdn.com/t/font_2760835_qb1mhfn9uo.ttf?t=1629603897039') format('truetype');
    }

    .nexmoe-dark-home {
    }

    .nexmoe-dark-switch-body {
        padding: 10px;
        margin: auto;
    }

    .nexmoe-dark-switch-groove {
        font-family: iconfont;
        width: 90px;
        height: 25px;
        border-radius: 45px;
        background-color: #eeeeee;
        position: relative;
    }

    @keyframes nexmoe-dark-switch-button-on {
        0% {
            left: -5px;
        }
        100% {
            left: 55px;
        }
    }

    @keyframes nexmoe-dark-switch-button-off {
        0% {
            left: 55px;
        }
        100% {
            left: -5px;
        }
    }

    .nexmoe-dark-switch-button {
        width: 40px;
        height: 40px;
        position: absolute;
        bottom: -7.5px;
        left: -5px;
        /*left: 55px;*/
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        color: #ff4e6a;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LUNAR.STORE | Login</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css?v=3.2.0">
    <script nonce="7230e55e-12da-41a8-b1b1-5c57d088a4ae">
        try {
            (function(w, d) {
                ! function(o, p, q, r) {
                    o[q] = o[q] || {};
                    o[q].executed = [];
                    o.zaraz = {
                        deferred: [],
                        listeners: []
                    };
                    o.zaraz.q = [];
                    o.zaraz._f = function(s) {
                        return async function() {
                            var t = Array.prototype.slice.call(arguments);
                            o.zaraz.q.push({
                                m: s,
                                a: t
                            })
                        }
                    };
                    for (const u of ["track", "set", "debug"]) o.zaraz[u] = o.zaraz._f(u);
                    o.zaraz.init = () => {
                        var v = p.getElementsByTagName(r)[0],
                            w = p.createElement(r),
                            x = p.getElementsByTagName("title")[0];
                        x && (o[q].t = p.getElementsByTagName("title")[0].text);
                        o[q].x = Math.random();
                        o[q].w = o.screen.width;
                        o[q].h = o.screen.height;
                        o[q].j = o.innerHeight;
                        o[q].e = o.innerWidth;
                        o[q].l = o.location.href;
                        o[q].r = p.referrer;
                        o[q].k = o.screen.colorDepth;
                        o[q].n = p.characterSet;
                        o[q].o = (new Date).getTimezoneOffset();
                        if (o.dataLayer)
                            for (const B of Object.entries(Object.entries(dataLayer).reduce(((C, D) => ({
                                    ...C[1],
                                    ...D[1]
                                })), {}))) zaraz.set(B[0], B[1], {
                                scope: "page"
                            });
                        o[q].q = [];
                        for (; o.zaraz.q.length;) {
                            const E = o.zaraz.q.shift();
                            o[q].q.push(E)
                        }
                        w.defer = !0;
                        for (const F of [localStorage, sessionStorage]) Object.keys(F || {}).filter((H => H.startsWith("_zaraz_"))).forEach((G => {
                            try {
                                o[q]["z_" + G.slice(7)] = JSON.parse(F.getItem(G))
                            } catch {
                                o[q]["z_" + G.slice(7)] = F.getItem(G)
                            }
                        }));
                        w.referrerPolicy = "origin";
                        w.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(o[q])));
                        v.parentNode.insertBefore(w, v)
                    };
                    ["complete", "interactive"].includes(p.readyState) ? zaraz.init() : o.addEventListener("DOMContentLoaded", zaraz.init)
                }(w, d, "zarazData", "script");
            })(window, document)
        } catch (e) {
            throw fetch("/cdn-cgi/zaraz/t"), e;
        };
    </script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>" class="h1"><b>LUNAR.</b>STORE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <?php
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        <?php foreach ($errors as $key => $error) { ?>
                            <li><?= esc($error) ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>

                <?php
            if (session()->getFlashData('gagal')) {
                echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i ></i>';
                echo session()->getFlashData('gagal');
                echo '</div>';
            } ?>

                <?php echo form_open('Home/CekLogin') ?>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                </div>
                <?php form_close() ?>

            </div>

        </div>

    </div>


    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>

    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css" rel="stylesheet" media="all">
        *:not(br):not(tr):not(html) {
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: "";
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        * {
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0px;
            height: 100%;
        }

        /* a blue color as a generic focus style */
        button:focus-visible {
            outline: 2px solid #4a90e2 !important;
            outline: -webkit-focus-ring-color auto 5px !important;
        }

        a {
            text-decoration: none;
        }

        @import url("https://fonts.googleapis.com/css?family=Poppins:400");

        .notif-email {
            background-color: #ffffff;
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
        }

        .notif-email .overlap-wrapper {
            background-color: #ffffff;
            width: 762px;
            height: 559px;
        }

        .email-wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #f5f7f9;
        }

        .email-content {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        p.center {
            text-align: center;
        }

        p,
        br.sub {
            font-size: 12px;
        }

        .notif-email .overlap {
            position: relative;
            width: 694px;
            height: 502px;
            top: 30px;
            left: 28px;
        }

        .notif-email .overlap-group {
            position: absolute;
            width: 694px;
            height: 459px;
            top: 43px;
            left: 0;
        }

        .notif-email .vector {
            position: absolute;
            width: 66px;
            height: 75px;
            top: 0;
            left: 0;
        }

        .notif-email .img {
            position: absolute;
            width: 66px;
            height: 75px;
            top: 378px;
            left: 0;
        }

        .notif-email .rectangle {
            position: absolute;
            width: 681px;
            height: 388px;
            top: 43px;
            left: 13px;
            background-color: #f8f7f3;
            border-radius: 30px;
        }

        .notif-email .group {
            position: absolute;
            width: 56px;
            height: 56px;
            top: 403px;
            left: 545px;
        }

        .notif-email .group-2 {
            position: absolute;
            width: 56px;
            height: 6px;
            top: 0;
            left: 0;
        }

        .notif-email .div {
            position: absolute;
            width: 56px;
            height: 6px;
            top: 50px;
            left: 0;
        }

        .notif-email .ellipse {
            width: 6px;
            height: 6px;
            left: 0;
            background-color: #6ac8d280;
            border-radius: 3px;
            position: absolute;
            top: 0;
        }

        .notif-email .ellipse-2 {
            left: 10px;
            background-color: #6ac8d280;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-3 {
            left: 20px;
            background-color: #6ac8d280;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-4 {
            left: 30px;
            background-color: #6ac8d280;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-5 {
            left: 40px;
            background-color: #6ac8d280;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-6 {
            left: 50px;
            background-color: #6ac8d280;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .group-3 {
            position: absolute;
            width: 56px;
            height: 6px;
            top: 40px;
            left: 0;
        }

        .notif-email .group-4 {
            position: absolute;
            width: 56px;
            height: 6px;
            top: 30px;
            left: 0;
        }

        .notif-email .group-5 {
            position: absolute;
            width: 56px;
            height: 6px;
            top: 20px;
            left: 0;
        }

        .notif-email .group-6 {
            position: absolute;
            width: 56px;
            height: 6px;
            top: 10px;
            left: 0;
        }

        .notif-email .hai-ahmad-selamat {
            position: absolute;
            width: 667px;
            height: 399px;
            top: 31px;
            left: 20px;
            font-family: "Poppins", Helvetica;
            font-weight: 400;
            color: transparent;
            font-size: 15px;
            letter-spacing: 0.15px;
            line-height: 24px;
        }

        .notif-email .text-wrapper {
            color: #53565a;
        }

        .notif-email .span {
            color: #1f78ee;
        }

        .notif-email .text-wrapper-2 {
            color: #1f78ef;
        }

        .notif-email .group-7 {
            position: absolute;
            width: 56px;
            height: 56px;
            top: 15px;
            left: 631px;
        }

        .notif-email .ellipse-7 {
            left: 0;
            background-color: #d00a0a80;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-8 {
            left: 10px;
            background-color: #d00a0a80;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-9 {
            left: 20px;
            background-color: #d00a0a80;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-10 {
            left: 30px;
            background-color: #d00a0a80;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-11 {
            left: 40px;
            background-color: #d00a0a80;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .ellipse-12 {
            left: 50px;
            background-color: #d00a0a80;
            position: absolute;
            width: 6px;
            height: 6px;
            top: 0;
            border-radius: 3px;
        }

        .notif-email .group-8 {
            position: absolute;
            width: 227px;
            height: 49px;
            top: 0;
            left: 240px;
        }

        .notif-email .group-9 {
            position: absolute;
            width: 56px;
            height: 49px;
            top: 0;
            left: 0;
        }

        .notif-email .overlap-group-2 {
            position: absolute;
            width: 45px;
            height: 49px;
            top: 0;
            left: 11px;
        }

        .notif-email .rectangle-2 {
            position: absolute;
            width: 11px;
            height: 49px;
            top: 0;
            left: 20px;
            background-color: #fec395;
            border-radius: 100px;
        }

        .notif-email .rectangle-3 {
            position: absolute;
            width: 11px;
            height: 45px;
            top: 2px;
            left: 17px;
            border-radius: 0px 100px 0px 0px;
            transform: rotate(90deg);
            background: linear-gradient(180deg,
                    rgb(208.25, 10.41, 10.41) 0.34%,
                    rgba(208.25, 10.41, 10.41, 0.93) 56.03%,
                    rgba(208.25, 10.41, 10.41, 0.5) 100%);
        }

        .notif-email .rectangle-4 {
            position: absolute;
            width: 11px;
            height: 49px;
            top: 0;
            left: 0;
            background-color: #6ac8d2;
            border-radius: 100px;
        }

        .notif-email .group-10 {
            position: absolute;
            width: 156px;
            height: 27px;
            top: 11px;
            left: 71px;
        }

        .notif-email .group-11 {
            position: absolute;
            width: 15px;
            height: 23px;
            top: 2px;
            left: 46px;
        }

        .notif-email .group-12 {
            position: absolute;
            width: 19px;
            height: 27px;
            top: 0;
            left: 90px;
        }

        .notif-email .group-13 {
            position: absolute;
            width: 19px;
            height: 27px;
            top: 0;
            left: 137px;
        }

        .notif-email .group-14 {
            position: absolute;
            width: 21px;
            height: 25px;
            top: 1px;
            left: 21px;
        }

        .notif-email .group-15 {
            position: absolute;
            width: 21px;
            height: 25px;
            top: 1px;
            left: 113px;
        }

        .notif-email .group-16 {
            position: absolute;
            width: 18px;
            height: 23px;
            top: 2px;
            left: 0;
        }

        .notif-email .rectangle-5 {
            position: absolute;
            width: 3px;
            height: 23px;
            top: 0;
            left: 0;
            background-color: #6ac8d2;
        }

        .notif-email .overlap-group-3 {
            position: absolute;
            width: 12px;
            height: 23px;
            top: 0;
            left: 6px;
        }

        .notif-email .rectangle-6 {
            position: absolute;
            width: 3px;
            height: 23px;
            top: 0;
            left: 10px;
        }

        .notif-email .rectangle-7 {
            position: absolute;
            width: 10px;
            height: 3px;
            top: 10px;
            left: 0;
        }

        .notif-email .group-wrapper {
            position: absolute;
            width: 23px;
            height: 23px;
            top: 2px;
            left: 64px;
        }

        .notif-email .overlap-group-wrapper {
            height: 23px;
            background-color: #c7c5ac;
            border-radius: 11.33px;
        }

        .notif-email .overlap-group-4 {
            position: relative;
            width: 23px;
            height: 18px;
            top: 2px;
        }

        .notif-email .ellipse-13 {
            width: 18px;
            height: 18px;
            left: 2px;
            background-color: #ffffff;
            border-radius: 8.96px;
            position: absolute;
            top: 0;
        }

        .body-action {
            width: 100%;
            margin: 30px auto;
            padding: 0;
            text-align: center;
        }

        .notif-email .rectangle-8 {
            position: absolute;
            width: 23px;
            height: 3px;
            top: 7px;
            left: 0;
            background-color: #ffffff;
        }

        .email-body {
            width: 100%;
            margin: 0;
            padding: 0;
            border-top: 1px solid #e7eaec;
            border-bottom: 1px solid #e7eaec;
            background-color: #ffffff;
        }

        .email-body_inner {
            width: 570px;
            margin: 0 auto;
            padding: 0;
        }

        .content-cell {
            padding: 35px;
        }

        /*Media Queries ------------------------------ */
        @media only screen and (max-width: 600px) {

            .email-body_inner,
            .email-footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="email-body" width="100%">
                            <table class="email-body_inner" align="center" width="570" cellpadding="0"
                                cellspacing="0">
                                <tr>
                                    <td class="content-cell">
                                        <table class="body-action" align="center" width="100%" cellpadding="0"
                                            cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                    <div>
                                                        <div class="notif-email">
                                                            <div class="overlap-wrapper">
                                                                <div class="overlap">
                                                                    <div class="overlap-group">
                                                                        <!-- svg 1-->
                                                                        <svg width="66" height="75"
                                                                            viewBox="0 0 66 75" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M32.3208 0.00187086C46.1385 -0.132991 60.6254 7.01569 64.8818 23.9424C69.1278 40.8277 60.704 57.6784 49.3594 67.7601C38.9338 77.025 25.3787 77.6111 14.9875 68.2821C3.9144 58.3409 -2.94957 41.0845 1.24435 24.5635C5.41924 8.11745 18.8832 0.133022 32.3208 0.00187086Z"
                                                                                fill="#FEC395" fill-opacity="0.5" />
                                                                        </svg>
                                                                        <!-- svg 2-->
                                                                        <div class="img">
                                                                            <svg width="66" height="75"
                                                                                viewBox="0 0 66 75" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path opacity="0.5" fill-rule="evenodd"
                                                                                    clip-rule="evenodd"
                                                                                    d="M32.3208 0.00187086C46.1385 -0.132991 60.6254 7.01569 64.8818 23.9424C69.1278 40.8277 60.704 57.6784 49.3594 67.7601C38.9338 77.025 25.3787 77.6111 14.9875 68.2821C3.9144 58.3409 -2.94957 41.0845 1.24435 24.5635C5.41924 8.11745 18.8832 0.133022 32.3208 0.00187086Z"
                                                                                    fill="#6AC8D2"
                                                                                    fill-opacity="0.61" />
                                                                            </svg>
                                                                        </div>
                                                                        <div class="rectangle"></div>
                                                                        <div class="group">
                                                                            <img class="group-2"
                                                                                src="https://alibabaspaces.betalogika.tech/assets/emailverify/img/group-35114.png" />
                                                                            <div class="div">
                                                                                <div class="ellipse"></div>
                                                                                <div class="ellipse-2"></div>
                                                                                <div class="ellipse-3"></div>
                                                                                <div class="ellipse-4"></div>
                                                                                <div class="ellipse-5"></div>
                                                                                <div class="ellipse-6"></div>
                                                                            </div>
                                                                            <div class="group-3">
                                                                                <div class="ellipse"></div>
                                                                                <div class="ellipse-2"></div>
                                                                                <div class="ellipse-3"></div>
                                                                                <div class="ellipse-4"></div>
                                                                                <div class="ellipse-5"></div>
                                                                                <div class="ellipse-6"></div>
                                                                            </div>
                                                                            <div class="group-4">
                                                                                <div class="ellipse"></div>
                                                                                <div class="ellipse-2"></div>
                                                                                <div class="ellipse-3"></div>
                                                                                <div class="ellipse-4"></div>
                                                                                <div class="ellipse-5"></div>
                                                                                <div class="ellipse-6"></div>
                                                                            </div>
                                                                            <div class="group-5">
                                                                                <div class="ellipse"></div>
                                                                                <div class="ellipse-2"></div>
                                                                                <div class="ellipse-3"></div>
                                                                                <div class="ellipse-4"></div>
                                                                                <div class="ellipse-5"></div>
                                                                                <div class="ellipse-6"></div>
                                                                            </div>
                                                                            <div class="group-6">
                                                                                <div class="ellipse"></div>
                                                                                <div class="ellipse-2"></div>
                                                                                <div class="ellipse-3"></div>
                                                                                <div class="ellipse-4"></div>
                                                                                <div class="ellipse-5"></div>
                                                                                <div class="ellipse-6"></div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- email body -->
                                                                        <p class="hai-ahmad-selamat">
                                                                            <br />
                                                                            <br />
                                                                            <span class="text-wrapper">Hai
                                                                                {{ $username }}!<br />
                                                                                <br />Selamat datang di HaloKak!
                                                                                <br />Untuk melanjutkan pendaftaran
                                                                                silahkan verifikasi bahwa email:
                                                                                {{ $email }} ini benar anda
                                                                                <br />dengan
                                                                                klik link berikut :
                                                                            </span>
                                                                            <span class="span"><a
                                                                                    href="{{ $url }}"
                                                                                    target="_blank">Verify Account</a>
                                                                                <br /></span>
                                                                            <span class="text-wrapper">
                                                                                <br />Jika Anda memiliki pertanyaan,
                                                                                <br />jangan ragu untuk menghubungi
                                                                                layanan pelanggan kami di
                                                                            </span>
                                                                            <span class="text-wrapper-2"><a
                                                                                    href="mailto:halokakteam@gmail.com
">HalokakTeam</a><br /></span>
                                                                            <span class="text-wrapper">
                                                                                <br />Terima kasih! <br />
                                                                                <br />Tim HaloKak</span>
                                                                        </p>
                                                                        <div class="group-7">
                                                                            <img class="group-2"
                                                                                src="https://alibabaspaces.betalogika.tech/assets/emailverify/img/group-35114-1.png" />
                                                                            <div class="div">
                                                                                <div class="ellipse-7"></div>
                                                                                <div class="ellipse-8"></div>
                                                                                <div class="ellipse-9"></div>
                                                                                <div class="ellipse-10"></div>
                                                                                <div class="ellipse-11"></div>
                                                                                <div class="ellipse-12"></div>
                                                                            </div>
                                                                            <div class="group-3">
                                                                                <div class="ellipse-7"></div>
                                                                                <div class="ellipse-8"></div>
                                                                                <div class="ellipse-9"></div>
                                                                                <div class="ellipse-10"></div>
                                                                                <div class="ellipse-11"></div>
                                                                                <div class="ellipse-12"></div>
                                                                            </div>
                                                                            <div class="group-4">
                                                                                <div class="ellipse-7"></div>
                                                                                <div class="ellipse-8"></div>
                                                                                <div class="ellipse-9"></div>
                                                                                <div class="ellipse-10"></div>
                                                                                <div class="ellipse-11"></div>
                                                                                <div class="ellipse-12"></div>
                                                                            </div>
                                                                            <div class="group-5">
                                                                                <div class="ellipse-7"></div>
                                                                                <div class="ellipse-8"></div>
                                                                                <div class="ellipse-9"></div>
                                                                                <div class="ellipse-10"></div>
                                                                                <div class="ellipse-11"></div>
                                                                                <div class="ellipse-12"></div>
                                                                            </div>
                                                                            <div class="group-6">
                                                                                <div class="ellipse-7"></div>
                                                                                <div class="ellipse-8"></div>
                                                                                <div class="ellipse-9"></div>
                                                                                <div class="ellipse-10"></div>
                                                                                <div class="ellipse-11"></div>
                                                                                <div class="ellipse-12"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="group-8">
                                                                        <div class="group-9">
                                                                            <div class="overlap-group-2">
                                                                                <div class="rectangle-2"></div>
                                                                                <div class="rectangle-3"></div>
                                                                            </div>
                                                                            <div class="rectangle-4"></div>
                                                                        </div>
                                                                        <div class="group-10">
                                                                            <img class="group-11"
                                                                                src="https://alibabaspaces.betalogika.tech/assets/emailverify/img/group-35212.png" />
                                                                            <img class="group-12"
                                                                                src="https://alibabaspaces.betalogika.tech/assets/emailverify/img/group-35207.png" />
                                                                            <img class="group-13"
                                                                                src="https://alibabaspaces.betalogika.tech/assets/emailverify/img/group-35214.png" />
                                                                            <img class="group-14"
                                                                                src="https://alibabaspaces.betalogika.tech/assets/emailverify/img/group-35211.png" />
                                                                            <img class="group-15"
                                                                                src="https://alibabaspaces.betalogika.tech/assets/emailverify/img/group-35213.png" />
                                                                            <div class="group-16">
                                                                                <div class="rectangle-5"></div>
                                                                                <div class="overlap-group-3">
                                                                                    <div class="rectangle-6">
                                                                                        <svg width="3"
                                                                                            height="23"
                                                                                            viewBox="0 0 3 23"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M0.214844 0.349617H2.91968V23.0026H0.214844V0.349617Z"
                                                                                                fill="#6AC8D2" />
                                                                                        </svg>
                                                                                    </div>
                                                                                    <svg width="11" height="3"
                                                                                        viewBox="0 0 11 3"
                                                                                        fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path
                                                                                            d="M10.4604 0.154617L10.4837 2.85935L0.534831 2.94489L0.511575 0.240161L10.4604 0.154617Z"
                                                                                            fill="#6AC8D2" />
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <div class="group-wrapper">
                                                                                <div class="overlap-group-wrapper">
                                                                                    <div class="overlap-group-4">
                                                                                        <div class="ellipse-13"></div>
                                                                                        <div class="rectangle-8"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

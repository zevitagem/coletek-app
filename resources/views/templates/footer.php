                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="styleSelector">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--[if lt IE 10]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
                <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="../files/assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="../files/assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="../files/assets/images/browser/ie.png" alt="">
                            <div>IE (9 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->


    <script type="text/javascript" src="<?= asset('theme/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/popper.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/waves.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/jquery.slimscroll.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/jquery.flot.js') ?>" ></script>
    <script type="text/javascript" src="<?= asset('theme/js/jquery.flot.categories.js') ?>" ></script>
    <script type="text/javascript" src="<?= asset('theme/js/curvedlines.js') ?>" ></script>
    <script type="text/javascript" src="<?= asset('theme/js/jquery.flot.tooltip.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/amcharts.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/serial.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/light.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/markerclusterer.js') ?>"></script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="<?= asset('theme/js/gmaps.js') ?>"></script>
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>-->

    <script type="text/javascript" src="<?= asset('theme/js/pcoded.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/vertical-layout.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/crm-dashboard.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/script.min.js') ?>"></script>
    <script src="<?= asset('theme/js/rocket-loader.min.js') ?>" data-cf-settings="2d8d78e876b340f9029c575b-|49" defer=""></script></body>
    <script src="<?= asset('vendors/ladda/js/spin.min.js') ?>"></script>
    <script src="<?= asset('vendors/ladda/js/ladda.min.js') ?>"></script>

    <?php
    if (!empty($assets['js'])) {
        foreach ($assets['js'] as $js) {
            ?>
            <script type="text/javascript" src="<?= asset($js) ?>"></script>
            <?php 
        }
    }
    ?>

    <!-- Mirrored from colorlib.com/polygon/admindek/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:32 GMT -->
</html>

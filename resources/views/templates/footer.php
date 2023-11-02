                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="styleSelector"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Os scripts abaixo vieram juntamente com o tema -->
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
    <script type="text/javascript" src="<?= asset('theme/js/vertical-layout.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/pcoded.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/crm-dashboard.min.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('theme/js/script.min.js') ?>"></script>
    <script src="<?= asset('theme/js/rocket-loader.min.js') ?>" data-cf-settings="2d8d78e876b340f9029c575b-|49" defer=""></script></body>
    
    <!-- Os scripts são os que realmente eu uso na regra de negócio do sistema -->
    <script src="<?= asset('vendors/ladda/js/spin.min.js') ?>"></script>
    <script src="<?= asset('vendors/ladda/js/ladda.min.js') ?>"></script>
    <script src="<?= asset('app/app.js') ?>"></script>

    <?php
    if (!empty($assets['js'])) {
        foreach ($assets['js'] as $js) {
            ?>
            <script type="text/javascript" src="<?= asset($js) ?>"></script>
            <?php 
        }
    }
    ?>
</html>

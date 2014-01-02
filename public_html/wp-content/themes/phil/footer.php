        
        <footer>
            <p>&copy; Philip Stavrou <?= date('Y');?></p>
        </footer>
    </div> <!-- wrapper -->        
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="<?php bloginfo("template_url"); ?>/assets/js/vendor/jquery-1.10.1.min.js"></script>

        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/vendor/jquery.navobile.min.js"></script>

        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/main.js"></script>
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        <?php wp_footer(); ?>
    </body>
</html>
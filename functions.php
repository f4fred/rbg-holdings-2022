<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# Gutenberg
# ------------------------------------------
include('extensions/bir-blocks/functions/blocks-functions.php');

# ------------------------------------------
# Protected Login Extensions
# ------------------------------------------
include('extensions/bir-protected-login/functions/pl-functions.php');

# ------------------------------------------
# Dashboard Extensions
# ------------------------------------------
include('extensions/bir-dashboard/dashboard-acf.php');
include('extensions/bir-dashboard/dashboard-customiser.php');
include('extensions/bir-dashboard/dashboard-duplicate-posts.php');
include('extensions/bir-dashboard/dashboard-enqueue.php');
include('extensions/bir-dashboard/dashboard-menu-walkers.php');
include('extensions/bir-dashboard/dashboard-misc-functions.php');
include('extensions/bir-dashboard/dashboard-pagination.php');
include('extensions/bir-dashboard/dashboard-security.php');
include('extensions/bir-dashboard/dashboard-acf-search.php');
include('extensions/bir-dashboard/dashboard-widgets.php');
include('extensions/bir-dashboard/dashboard-cpt.php');
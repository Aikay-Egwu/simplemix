<?php
    /**
     * Footer
     *
     * Main footer file for the theme.
     *
     * @category   Components
     * @package    Simplemix
     * @subpackage Config
     * @author     Your Name <justaikay@gmail.com>
     * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
     * @link       https://simplemix.com
     * @since      1.0.0
     */

    /**
     *  Loads the twig library for use by the controller
     *  but i feel it should be the view
     *
     * @return null [description]
     */
function loadTwig()
{
    $loader = new Twig_Loader_Filesystem(VIEWS_PATH);
    $twig = new Twig_Environment(
        $loader,
        array(
        'cache' => CACHE_PATH,
        )
    );
}

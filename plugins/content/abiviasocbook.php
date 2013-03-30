<?php
/**
 * Abivia Social Bookmarking Plugin.
 *
 * @version $Id: abiviasocbook.php 2009-05-06  $
 * @package SocBook
 * @copyright (C) 2009 by Abivia Inc. All rights reserved.
 * @license GNU/GPL
 * @link http://www.abivia.net/
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgContentAbiviasocbook extends JPlugin {

    function __construct(&$subject, $params) {
        parent::__construct($subject, $params);
    }

    protected function _addColor($params, $paramName, $varName = '', $supress = '', $default = '') {
        if ($varName === '') {
            $varName = $paramName;
        }
        $val = $params -> get($paramName, $default);
        if (strlen($val) && $val[0] != '#') {
            $val = '#' . $val;
        }
        return $val == $supress ? '' : $varName . ' = "' . addcslashes($val, '"') . '";' . chr(10);
    }

    protected function _addInt($params, $paramName, $varName = '', $supress = '', $default = '') {
        if ($varName === '') {
            $varName = $paramName;
        }
        $val = $params -> get($paramName, $default);
        return $val == $supress ? '' : $varName . ' = ' . (int) $val . ';' . chr(10);
    }

    protected function _addVar($params, $paramName, $varName = '', $supress = '', $default = '') {
        if ($varName === '') {
            $varName = $paramName;
        }
        $val = $params -> get($paramName, $default);
        return $val == $supress ? '' : $varName . ' = "' . addcslashes($val, '"') . '";' . chr(10);
    }

    protected function _generateHtml(&$article, $myParams) {
        $html = '';
        // We're only interested if this is a content position
        if (JFactory::getApplication() -> scope != 'com_content') {
            return $html;
        }
        $document = JFactory::getDocument();
        $view = JRequest::getCmd('view');
        // We're only interested in article and possibly front page views
        if (
            !(
                $view == 'article'
                || ($myParams -> get('frontpage', true) && $view == 'frontpage')
                || ($myParams -> get('section', true) && $view == 'section')
                || ($myParams -> get('category', true) && $view == 'category')
            )
        ) {
            return $html;
        }
        /*
         * Apply filters for section, category, article.
         */
        $sectionIDList = array();
        $sectionMode = '';
        foreach (explode(',', $myParams -> get('sectionIDList', '')) as $num) {
            if (is_numeric($num)) {
                if ($sectionMode == '') {
                    if ($num[0] == '-') {
                        $sectionMode = '-';
                    } else {
                        $sectionMode = '+';
                    }
                }
                if ($num[0] == '-') {
                    $sectionIDList[] = -1 * (int) $num;
                } else {
                    $sectionIDList[] = (int) $num;
                }
            }
        }
        if (
            $sectionMode
            && (in_array($article -> sectionid, $sectionIDList) != ($sectionMode == '+'))
        ) {
            return $html;
        }
        $categoryIDList = array();
        $categoryMode = '';
        foreach (explode(',', $myParams -> get('categoryIDList', '')) as $num) {
            if (is_numeric($num)) {
                if ($categoryMode == '') {
                    if ($num[0] == '-') {
                        $categoryMode = '-';
                    } else {
                        $categoryMode = '+';
                    }
                }
                if ($num[0] == '-') {
                    $categoryIDList[] = -1 * (int) $num;
                } else {
                    $categoryIDList[] = (int) $num;
                }
            }
        }
        if (
            $categoryMode
            && (in_array($article -> catid, $categoryIDList) != ($categoryMode == '+'))
        ) {
            return $html;
        }
        $articleIDList = array();
        $articleMode = '';
        foreach (explode(',', $myParams -> get('articleIDList', '')) as $num) {
            if (is_numeric($num)) {
                if ($articleMode == '') {
                    if ($num[0] == '-') {
                        $articleMode = '-';
                    } else {
                        $articleMode = '+';
                    }
                }
                if ($num[0] == '-') {
                    $articleIDList[] = -1 * (int) $num;
                } else {
                    $articleIDList[] = (int) $num;
                }
            }
        }
        if (
            $articleMode
            && (in_array($article -> id, $articleIDList) != ($articleMode == '+'))
        ) {
            return $html;
        }
        /*
         * If we're not in the article view, use a URL that goes directly to the target.
         */
        if ($view != 'article') {
            /*
             * If the user can't see the full article, then they can't share it.
             */
            if ($article -> access > JFactory::getUser() -> get('aid')) {
                return $html;
            }
            $uri = JURI::getInstance(JURI::base());
            $shareUrl = $uri -> toString(array('scheme', 'host', 'port'))
                . JRoute::_(
                    ContentHelperRoute::getArticleRoute(
                        $article -> slug, $article -> catslug, $article -> sectionid
                    )
                );
            $shareTitle = $article -> title;
        } else {
            $shareUrl = '[URL]';
            $shareTitle = '[TITLE]';
        }
        if ($myParams -> get('useAddThis', '')) {
            $imgLanguage = $myParams -> get('language', 'en');
            $style = $myParams -> get('addthis_buttonstyle', 'share');
            $img = 'http://s7.addthis.com/static/btn/';
            switch ($myParams -> get('addthis_buttonsize', 'lg')) {
                case '-': {
                    $img = $myParams -> get(
                        'addthis_buttonimage',
                        'http://s7.addthis.com/static/btn/lg-share-' . $imgLanguage . '.gif'
                    );
                }
                break;

                case '0': {
                    $img = '';
                }
                break;

                case 'sm': {
                    if (in_array($style, array('bookmark', 'plus', 'share'))) {
                        if ($style == 'plus') {
                            $imgLanguage = '';
                        } else {
                            $style .= '-';
                        }
                    } else {
                        $style = 'share-';
                    }
                    $img .= 'sm-' . $style . $imgLanguage . '.gif' . '';
                }
                break;

                default:
                case 'lg': {
                    if (!in_array($style, array('addthis', 'bookmark', 'share'))) {
                        $style = 'share';
                    }
                    $img .= 'lg-' . $style . '-' . $imgLanguage . '.gif';
                }
                break;

            }
            $html .= '<div><!-- AddThis Button by Abivia.net SocBook Plugin -->' . chr(10)
                . '<script type="text/javascript">' . chr(10)
                . $this -> _addVar($myParams, 'addthis_pub')
                . $this -> _addVar($myParams, 'language', 'addthis_language', '', 'en')
                . $this -> _addVar($myParams, 'addthis_brand')
                . $this -> _addVar($myParams, 'addthis_options')
                . $this -> _addColor($myParams, 'addthis_header_color')
                . $this -> _addColor($myParams, 'addthis_header_background')
                . $this -> _addInt($myParams, 'addthis_offset_top')
                . $this -> _addInt($myParams, 'addthis_offset_left')
                . $this -> _addInt($myParams, 'addthis_hover_delay')
                . '</script>' . chr(10)
                . '<a href="http://www.addthis.com/bookmark.php?v=20"'
                . ' onmouseover="return addthis_open('
                . 'this, \'\', \'' . $shareUrl . '\', \''. $shareTitle . '\''
                . ')"'
                . ' onmouseout="addthis_close()"'
                . ' onclick="return addthis_sendto()">'
                . ($img == '' ? '' : '<img src="' . $img . '" alt="Share" border="0"/>')
                . $myParams -> get('addthis_text', '')
                . '</a>'
                . '<script type="text/javascript" src="http://s7.addthis.com/js/152/addthis_widget.js"></script>' . chr(10)
                . '<!-- End AddThis -->' . chr(10)
                . '</div>'
                ;
        }
        $code = $myParams -> get('SharethisCode', '');
        if ($code) {
            $html .= '<div>' . $code
                . '<a href="' . $URI . '" onclick="SHARETHIS.addEntry({, {button:true});"></a>'
                . '</div>' . chr(10);
        }
        $code = $myParams -> get('TellafriendCode', '');
        if ($code) {
            $html .= '<div>' . $code . '</div>';
        }
        $code = $myParams -> get('CustomCode', '');
        if ($code) {
            $html .= '<div>' . $code . '</div>';
        }
        return $html;
    }

    function onAfterDisplayContent(&$article, &$params, $limitstart) {
        // Get plugin info
        $plugin = JPluginHelper::getPlugin('content', 'abiviasocbook');
        $myParams = new JParameter($plugin -> params);
        return $myParams -> get('placement') == 'afterDisplayContent'
            ? $this -> _generateHtml($article, $myParams) : '';
    }

    function onAfterDisplayTitle(&$article, &$params, $limitstart) {
        // Get plugin info
        $plugin = JPluginHelper::getPlugin('content', 'abiviasocbook');
        $myParams = new JParameter($plugin -> params);
        return $myParams -> get('placement') == 'afterDisplayTitle'
            ? $this -> _generateHtml($article, $myParams) : '';
    }

    function onBeforeDisplayContent(&$article, &$params, $limitstart) {
        // Get plugin info
        $plugin = JPluginHelper::getPlugin('content', 'abiviasocbook');
        $myParams = new JParameter($plugin -> params);
        return $myParams -> get('placement') == 'beforeDisplayContent'
            ? $this -> _generateHtml($article, $myParams) : '';
    }

    function onPrepareContent(&$article, &$params, $limitstart) {
        // Get plugin info
        $plugin = JPluginHelper::getPlugin('content', 'abiviasocbook');
        $myParams = new JParameter($plugin -> params);
        $placement = explode('.', $myParams -> get('placement'));
        if (count($placement) >= 2 && $placement[0] == 'content') {
            $html = $this -> _generateHtml($article, $myParams);
            if ($placement[1] == 'post') {
                $article -> text .= $html;
            } else {
                $article -> text = $html . $article -> text;
            }
        }
    }

}

<?php namespace HMIF\Libraries;

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class EmailDisplayer {

    private $css2inline;
    private $html;
    private $prefixStyle = '#mail-container';

    public function __construct()
    {
        $this->css2inline = new CssToInlineStyles;
    }

    public function setHtml($html)
    {
        $html = '<meta charset="utf-8">'.$html;
        $this->css2inline->setHTML($html);

        return $this;
    }

    public function setPrefixStyle($prefixStyle)
    {
        $this->prefixStyle = $prefixStyle;

        return $this;
    }

    public function parse()
    {
        $this->css2inline->setUseInlineStylesBlock();
        $this->css2inline->setStripOriginalStyleTags();
        $this->css2inline->setCleanup();
        $this->html = $this->css2inline->convert();

        return $this->getStyle() . $this->getBody();
    }

    private function getBody()
    {
        $pattern = '|<body(.*)>(.*)</body>|isU';
        preg_match($pattern, $this->html, $matches);
        $body = preg_replace('|<body|isU', '<div', $matches[0]);

        return $matches[0];
    }

    private function getStyle()
    {
        $css = '';
        $matches = array();

        preg_match_all('|<style(.*)>(.*)</style>|isU', $this->html, $matches);

        if ( ! empty($matches[2]))
        {
            foreach ($matches[2] as $match)
            {
                $css .= trim($match) . "\n";
            }
        }

        $css = $this->getPrefixedCss($css, $this->prefixStyle);
        $css = '<style>' . $css . '</style>';

        return $css;
    }

    private function getPrefixedCss($css, $prefix)
    {
        $parts = explode('}', $css);
        $mediaQueryStarted = false;
        foreach ($parts as &$part)
        {
            if (empty($part))
            {
                continue;
            }

            $partDetails = explode('{', $part);
            if (substr_count($part, "{") == 2)
            {
                $mediaQuery = $partDetails[0] . "{";
                $partDetails[0] = $partDetails[1];
                $mediaQueryStarted = true;
            }

            $subParts = explode(',', $partDetails[0]);
            foreach ($subParts as &$subPart)
            {
                if (trim($subPart) == "@font-face") continue;
                $subPart = $prefix . ' ' . trim($subPart);
            }

            if (substr_count($part, "{") == 2)
            {
                $part = $mediaQuery . "\n" . implode(', ', $subParts) . "{" . $partDetails[2];
            }
            elseif (empty($part[0]) && $mediaQueryStarted)
            {
                $mediaQueryStarted = false;
                $part = implode(', ', $subParts) . "{" . $partDetails[2] . "}\n"; //finish media query
            }
            elseif (isset($partDetails[1]))
            {
                $part = implode(', ', $subParts) . "{" . $partDetails[1];
            }
        }

        $prefixedCss = implode("}\n", $parts);

        return $prefixedCss;
    }

}

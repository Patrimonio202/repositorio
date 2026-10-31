<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMXPath;

// HtmlSeguro - v1.0 (30/10/2026): limpia el HTML escrito en el editor antes de mostrarlo a los visitantes.
// Quita scripts, formularios, objetos incrustados, atributos de eventos (onclick, onerror...) y enlaces
// javascript:. Conserva el formato normal (parrafos, negrita, listas, tablas, enlaces, imagenes) y los
// videos de YouTube/Vimeo. Si el editor de una cuenta de administrador es comprometido, el codigo
// inyectado no llega a los visitantes.
class HtmlSeguro
{
    private const PROHIBIDAS = [
        'script', 'style', 'object', 'embed', 'applet', 'form', 'input', 'button', 'textarea', 'select',
        'option', 'meta', 'link', 'base', 'frame', 'frameset', 'noscript', 'template', 'svg', 'math',
    ];

    private const ATRIBUTOS_URL = ['href', 'src', 'xlink:href', 'action', 'formaction', 'poster', 'data', 'srcset'];

    private const HOSTS_IFRAME = ['www.youtube.com', 'youtube.com', 'www.youtube-nocookie.com', 'player.vimeo.com'];

    public static function limpiar(?string $html): string
    {
        $html = (string) $html;
        if (trim($html) === '') {
            return '';
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $previo = libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8"><div id="__raiz">' . $html . '</div>', LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        libxml_use_internal_errors($previo);

        $raiz = $dom->getElementById('__raiz');
        if (!$raiz) {
            return e(strip_tags($html));
        }

        $elementos = [];
        foreach ((new DOMXPath($dom))->query('//div[@id="__raiz"]//*') as $nodo) {
            $elementos[] = $nodo;
        }

        foreach ($elementos as $el) {
            /** @var DOMElement $el */
            if (!$el->parentNode) {
                continue;   // ya se elimino junto con su padre
            }
            $etiqueta = strtolower($el->tagName);

            if (in_array($etiqueta, self::PROHIBIDAS, true) || ($etiqueta === 'iframe' && !self::iframePermitido($el))) {
                $el->parentNode->removeChild($el);
                continue;
            }

            foreach (iterator_to_array($el->attributes) as $atributo) {
                $nombre = strtolower($atributo->nodeName);
                $valor = $atributo->nodeValue;

                if (str_starts_with($nombre, 'on') || in_array($nombre, ['srcdoc', 'formaction'], true)) {
                    $el->removeAttribute($atributo->nodeName);
                } elseif (in_array($nombre, self::ATRIBUTOS_URL, true) && !self::urlSegura($valor, $etiqueta, $nombre)) {
                    $el->removeAttribute($atributo->nodeName);
                } elseif ($nombre === 'style' && preg_match('/expression\s*\(|javascript:|vbscript:|url\s*\(|@import|behavior\s*:/i', $valor)) {
                    $el->removeAttribute($atributo->nodeName);
                }
            }

            if ($etiqueta === 'a' && strtolower((string) $el->getAttribute('target')) === '_blank') {
                $el->setAttribute('rel', 'noopener noreferrer');
            }
        }

        $salida = '';
        foreach ($raiz->childNodes as $hijo) {
            $salida .= $dom->saveHTML($hijo);
        }
        return $salida;
    }

    private static function urlSegura(string $valor, string $etiqueta, string $atributo): bool
    {
        // los navegadores ignoran espacios y caracteres de control dentro del esquema ("java\nscript:")
        $limpio = strtolower(preg_replace('/[\x00-\x20\x7F]+/u', '', html_entity_decode($valor, ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?? '');
        if (preg_match('/^(javascript|vbscript|livescript|mocha):/', $limpio)) {
            return false;
        }
        if (str_starts_with($limpio, 'data:')) {
            return $etiqueta === 'img' && $atributo === 'src' && preg_match('#^data:image/(png|jpe?g|gif|webp);base64,#', $limpio) === 1;
        }
        return true;
    }

    private static function iframePermitido(DOMElement $iframe): bool
    {
        $host = parse_url(trim($iframe->getAttribute('src')), PHP_URL_HOST);
        $esquema = parse_url(trim($iframe->getAttribute('src')), PHP_URL_SCHEME);
        return $esquema === 'https' && is_string($host) && in_array(strtolower($host), self::HOSTS_IFRAME, true);
    }
}

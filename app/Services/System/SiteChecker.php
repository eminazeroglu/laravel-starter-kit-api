<?php

namespace App\Services\System;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class SiteChecker
{
    private $url;

    /**
     * @throws GuzzleException
     */
    private function http($url): bool|\Psr\Http\Message\ResponseInterface
    {
        try {
            $client = new Client();
            return $client->get($url);
        }
        catch (\Exception $e) {
            return false;
        }
    }

    public function setUrl($url): static
    {
        $this->url = $url;
        return $this;
    }

    private function html($html): DomCrawler
    {
        return new DomCrawler($html);
    }

    public function links($html, $parser, $prefix = null)
    {
        return $html->filter($parser)->each(function ($node) use ($prefix) {
            return ($prefix ?? '') . $node->attr('href');
        });
    }

    /**
     * @throws GuzzleException
     */
    public function get(): bool|DomCrawler
    {
        try {
            $html = $this->http($this->url);
            return $this->html($html->getBody()->__toString());
        }
        catch (\Exception $e) {
            return false;
        }
    }
}

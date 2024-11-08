<?php

namespace Threecolts\Phptest;

class UrlCounter
{
    // /**
    //  * This function counts how many unique normalized valid URLs were passed to the function
    //  *
    //  * Accepts a list of URLs
    //  *
    //  * Example:
    //  *
    //  * input: ['https://example.com']
    //  * output: 1
    //  *
    //  * Notes:
    //  *  - assume none of the URLs have authentication information (username, password).
    //  *
    //  * Normalized URL:
    //  *  - process in which a URL is modified and standardized: https://en.wikipedia.org/wiki/URL_normalization
    //  *
    //  *    For example.
    //  *    These 2 urls are the same:
    //  *    input: ["https://example.com", "https://example.com/"]
    //  *    output: 1
    //  *
    //  *    These 2 are not the same:
    //  *    input: ["https://example.com", "http://example.com"]
    //  *    output 2
    //  *
    //  *    These 2 are the same:
    //  *    input: ["https://example.com?", "https://example.com"]
    //  *    output: 1
    //  *
    //  *    These 2 are the same:
    //  *    input: ["https://example.com?a=1&b=2", "https://example.com?b=2&a=1"]
    //  *    output: 1
    //  */

    /* @var $urls : string[] */
    public function countUniqueUrls( $urls)
    {
        $normalizedUrls= [];
        foreach ($urls as $key => $value) {
            
            // This function i search on google becuase if do manually its take too much time to explode the url.
            // it will give us all information port, type, query
            $url_details = parse_url($value);

            // [scheme] => https
            // [host] => example.com
            // [path] => /
            // [query] => b=2&a=1


            $querySearch = '';
            if (isset($url_details['query'])) {
                // convert to array after ? 
                parse_str($url_details['query'], $queryParams);
                ksort($queryParams);
                $querySearch = http_build_query($queryParams);
            }

        
            $final_path='';
            if(isset($url_details['path'])){
                $final_path=rtrim($url_details['path'], '/');
            }
            $normalizedUrl = strtolower($url_details['scheme'] . '://' . $url_details['host'] . $final_path);

            if(!empty($querySearch)){
                // continate with url to push in array
                $normalizedUrl .= '?' . $querySearch;
            }
            $normalizedUrls[$normalizedUrl] = true;

        }
         return  count($normalizedUrls);
        
    }

    /**
     * This function counts how many unique normalized valid URLs were passed to the function per top level domain
     *
     * A top level domain is a domain in the form of example.com. Assume all top level domains end in .com
     * subdomain.example.com is not a top level domain.
     *
     * Accepts a list of URLs
     *
     * Example:
     *
     * input: ["https://example.com"]
     * output: ["example.com" => 1]
     *
     * input: ["https://example.com", "https://subdomain.example.com"]
     * output: ["example.com" => 2]
     *
     */
    /* @var $urls : string[] */
    public function countUniqueUrlsPerTopLevelDomain( $urls): array
    {
        $UniqueCounts= [];
    
        foreach ($urls as $key => $value) {
            
            // This function i search on google becuase if do manually its take too much time to explode the url.
            // it will give us all information port, type, query
            $url_details = parse_url($value);
            
            $explodeParts = explode('.', $url_details['host']);
    
            if (count($explodeParts) > 2) {
                $domain = implode('.', array_slice($explodeParts, -2));
            } else {
                $domain = $url_details['host'];
            }
            if (!isset($UniqueCounts[$domain])) {
                $UniqueCounts[$domain] = 1;
            }
        }

         return  $UniqueCounts;
        
    }
}